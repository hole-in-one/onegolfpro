/*
*
*	function to trim space from string
*
*/

function trim(s)
	{
		/*trim function to trim the space from field*/
		var l=0; var r=s.length -1;
		while(l < s.length && s[l] == ' ')
		{	l++; }
		while(r > l && s[r] == ' ')
		{	r-=1;	}
		return s.substring(l, r+1);
	}


/*
*
*	function to validate contact us form
*
*/

var validate_fn	=	function(){
	var re = /\S+@\S+\.\S+/; // email regex
	
	/*  below given code validate the empty fields*/
	
	var name	=	document.getElementById('uname').value;
	var email	=	document.getElementById('email').value;
	var subject	=	document.getElementById('subject').value;
	var url		=	document.getElementById('url').value;
	var comment	=	document.getElementById('comment').value;
	if(trim(name)==""){
		alert('Error : Please enter the value of name ');
		document.getElementById('uname').focus();
		return false;
	}else if(trim(email)==""){
		alert('Error : Please enter the value of Email address ');
		document.getElementById('email').focus();
		return false;
	}else if(!re.test(email)){
		alert('Error : Please enter the valid Email address ');
		document.getElementById('email').focus();
		return false;
	}else if(trim(subject)==""){
		alert('Error : Please enter the value of Subject ');
		document.getElementById('subject').focus();
		return false;
	}
	return true;
	
	/*  above given code validate the empty fields*/
}