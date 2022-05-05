function selectreg(){
	var x = document.getElementById("reg").value;

	$.ajax({
		url:"showtable.php",
		method:"POST",
		data:{id: x},
		success:function(data){
			$("#ans").html(data);
		}
	})
}

function selectdep(){
	var x = document.getElementById("dep").value;

	$.ajax({
		url:"showtabledep.php",
		method:"POST",
		data:{id: x},
		success:function(data){
			$("#ans").html(data);
		}
	})
}

