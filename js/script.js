function pilih_semua()
{
	// mengecek Banyak checkbox di dalam form
	jumKomponen = $("input:checkbox").length;
	
	// myForm[0] merupakan checkbox induk untuk centang semua data
	if(document.myForm[0].checked == false)
	{
		//jika status checked(false) maka akan checked(true) semuanya
		for(x = 1; x <= jumKomponen ; x++ )
		{
			if(document.myForm[x].type == "checkbox") document.myForm[x].checked = false;
		}
	}
	else 
	{
		//jika status checked(true) maka akan checked(false) semuanya
		for(x = 1; x <= jumKomponen ; x++ )
		{
			if(document.myForm[x].type == "checkbox") document.myForm[x].checked = true;
		}
	}
}
function konfirmasi()
{
	// jika checked lebih dari satu maka di exsekusi
	if($("input:checked").length > 0)
	{
		if(confirm('apakah anda yakin menghapus ?') == true)
		{
			return true;  
		} else {
			return false;
		}
	} else {
		alert("Anda Belum ada mencentang.");
		return false;
	}
}