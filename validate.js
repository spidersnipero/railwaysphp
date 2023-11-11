function validate()
{
	var name=document.getElementById("name");
	var mob=document.getElementById("mob");
	var EmailId=document.getElementById("email");
	var pw=document.getElementById("pw");
	var cpw=document.getElementById("cpw");
	var alphaExp = /^[a-zA-Z]+$/;
	var atpos = EmailId.value.indexOf("@");
    var dotpos = EmailId.value.lastIndexOf(".");
    if(name.value==null || name.value=="")
	{
		fname.focus();
		alert("Enter valid first name");
		return false;
	}
	if(name.value.match(alphaExp)){}
	else{
		alert("name can have only letters");
		name.focus();
		return false;
	}
	if(mob.value==null || mob.value==" ")
	{
		alert("Please Enter Mobile Number");
		mob.focus();
		return false;
	}
	if (isNaN(mob.value))
	{
		alert(" Your Mobile Number must be Integers");
		mob.focus();
		return false;
	}
	if((mob.value.length!= 10))
	{
		alert("Enter the valid Mobile Number(Like : 9669666999)");
		mob.focus();
		return false;
	}
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=EmailId.value.length) 
	{
        alert("Enter valid email-ID");
		EmailId.focus();
        return false;
   	}
 	if(pw.value.length< 8 || cpw.value.length< 8)
	{
		alert("Please enter a password of atleast 8 characters");
		pw.focus();
		return false;
	}
	else if (pw.value.length != cpw.value.length) 
	{
		alert("Passwords do not match.");
		pw.focus();
        return false;
    }
	else if (pw.value != cpw.value) 
	{
		alert("Passwords do not match.");
		pw.focus();
        return false;
    }
	return true;
}