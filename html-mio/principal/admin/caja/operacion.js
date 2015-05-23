function devuelveCambio()
{

	deuda = document.getElementById('totalPagar').value;
	saldo = document.getElementById('pagoVenta').value;

	cambio = saldo - deuda;

	if (cambio < 0) 
	{
		alert ("El saldo ingresado no es suficiente, ingresa un saldo mayor");
		document.getElementById("pagoVenta").focus();
	}
	else
	{
		document.getElementById("cambioTotal").value = cambio;
	}
}