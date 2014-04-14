function checkShippingAndPaymentInfo()
{
	with (window.document.frmCheckout) {
		if (isEmpty(name, 'Введите ваше имя')) {
			return false;
		} else if (isEmpty(phone, 'Введите ваш номер телефона')) {
			return false;
		} else if (isEmpty(email, 'Введите адрес электронной почты')) {
			return false;
		} else if (isEmpty(city, 'Введите ваш город')) {
			return false;
		} else {
			return true;
		}
	}
}
