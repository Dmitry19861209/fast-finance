var vmHandler = {
  init: function() {
    this.setObjects();
    this.setConstants();
    this.setEventHandlers();
  },
  setObjects: function() {
    this.element = {};
    this.element.token = $('[name="_token"]').val();
    this.element.alertNotifySuccess = $('.alert.notification.alert-success'); /* --- alerts --- */
    this.element.alertNotifyDanger = $('.alert.notification.alert-danger');
    this.element.alertSussess = $('.alert.box.alert-success');
    this.element.alertDanger = $('.alert.box.alert-danger');
    this.element.userBtnEnterMoney = $('.btn-enter-money'); /* --- user money --- */
    this.element.inputPaySum = $('#pay-sum'); /* --- display --- */
    this.element.btnMoneyBack = $('#money-back');
    this.element.btnBuy = $('.btn-buy'); /* --- products --- */
  },
  setConstants: function() {
    this.const = {};
    this.const.user = 1;
    this.const.vm = 2;
    this.const.errorNotMoney = "Кол-во монет 0";
    this.const.errorEnterMoney = "Не удалось внести платеж";
    this.const.errorBuy = "Недостаточно средств";
    this.const.errorMoneyBack = "Сдача не выдана";
  },
  setEventHandlers: function() {
    let btnEnterMoneyFromUserCallback = Function.createCallback(this.btnEnterMoneyFromUser, this);
    let btnBuyCallback = Function.createCallback(this.btnBuy, this);
    let btnMoneyBackCallback = Function.createCallback(this.btnMoneyBack, this);

    this.element.userBtnEnterMoney.on('click', btnEnterMoneyFromUserCallback);
    this.element.btnBuy.on('click', btnBuyCallback);
    this.element.btnMoneyBack.on('click', btnMoneyBackCallback);
  },
  showAlert: function(element, isNotify=false, message=null) {
    element.show();
    if(isNotify && message) {
      let scroll = $(document).scrollTop();
      element.css('top', scroll + 10);
      element.text(message);
    }
    setTimeout(function () {
      element.hide();
    }, 2500);
  },
  btnEnterMoneyFromUser: function(e, obj) {
    let tr = $(this).closest('.user-money-rows');
    obj.makePayment(obj, tr);

  },
  btnBuy: function(e, obj) {
    let tr = $(this).closest('.product-rows');
    obj.makePurchase(obj, tr);

  },
  makePayment: function (obj, tr) {
    let _token = obj.element.token,
      moneyId = tr.find('.td-id').text(),
      url = "/make-payment?_token=" + _token + "&moneyId=" + moneyId;

    $.ajax({
      type: 'POST',
      url: url,
      success: function (data) { console.log(data);
        let money = data.money;

        if (money) {
          obj.showAlert(obj.element.alertNotifySuccess, true, "Внесено рублей: " + money.value);
          obj.updateCount(money, tr);
          obj.displayUpdatePaySum(data.display, obj);
        } else
          obj.showAlert(obj.element.alertNotifyDanger, true, obj.const.errorEnterMoney);
      }
    });
  },
  makePurchase: function (obj, tr) {
    let _token = obj.element.token,
      productId = tr.find('.td-id').text(),
      url = "/make-purchase?_token=" + _token + "&productId=" + productId;

    $.ajax({
      type: 'POST',
      url: url,
      success: function (data) { console.log(data);
        let product = data.product,
          display = data.display;

        if (product && display) {
          obj.showAlert(obj.element.alertNotifySuccess, true, "Ваша покупка: " + product.name);
          obj.showAlert(obj.element.alertSussess);
          obj.displayUpdatePaySum(data.display, obj);
          obj.updateCount(product, tr);
          obj.updateArrayCount(obj, data.monies, 'vm-id-money');
        } else
          obj.showAlert(obj.element.alertNotifyDanger, true, obj.const.errorBuy);
      }
    });
  },
  btnMoneyBack: function (e, obj) {
    let _token = obj.element.token,
      url = "/money-back?_token=" + _token + "&paySum=" + obj.element.inputPaySum.val();

    $.ajax({
      type: 'POST',
      url: url,
      success: function (data) { console.log(data);
        let monies = data.monies,
          display = data.display;

        if (monies && display) {
          obj.updateArrayCount(obj, monies, 'user-id-money');
          obj.displayUpdatePaySum(display, obj);
          obj.showAlert(obj.element.alertNotifySuccess, true, "Ваша сдача");
        } else
          obj.showAlert(obj.element.alertNotifyDanger, true, obj.const.errorMoneyBack);
      }
    });
  },
  updateCount: function (model, tr) {
    tr.find('.count').text(model.count);
  },
  updateArrayCount: function (obj, monies, attr) {
    $.each(monies, function( index, value ) {
      let tr = $('[' + attr + '="' + value.id + '"]');
      obj.updateCount(value, tr);
    });
  },
  displayUpdatePaySum: function (display, obj) {
    obj.element.inputPaySum.val(display.pay_sum);
  },
};

$(document).ready(function() {
  vmHandler.init();
});
