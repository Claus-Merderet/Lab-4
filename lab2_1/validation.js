function validation()
{
    var form = document.getElementById("form");
    var email = document.getElementById("email").value;
    var number = document.getElementById("number").value;
    var name = document.getElementById("name").value;
    var text = document.getElementById("text");
    var text_name = document.getElementById("text_name");
    var text_number = document.getElementById("text_number");
    var pattern_email = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    var pattern_number = /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/;
    var pattern_name = /^[А-ЯA-Z][а-яa-zА-ЯA-Z\-]{0,}\s[А-ЯA-Z][а-яa-zА-ЯA-Z\-]{1,}(\s[А-ЯA-Z][а-яa-zА-ЯA-Z\-]{1,})?$/;
    if (email.match(pattern_email))
    {
        form.classList.add("valid");
        form.classList.remove("invalid");
        text.innerHTML = "Your Email Address in Valid.";
        text.style.color = "#0b00ab";
    }
    else
    {
        form.classList.remove("valid");
        form.classList.add("invalid");
        text.innerHTML = "Please Enter Valid Email Address";
        text.style.color = "#000000";
    }
    if (number.match(pattern_number))
    {
        form.classList.add("valid");
        form.classList.remove("invalid");
        text_number.innerHTML = "";
        text_number.style.color = "#0b00ab";
    }
    else
    {
        form.classList.remove("valid");
        form.classList.add("invalid");
        text_number.innerHTML = "Please Enter Valid Number";
        text_name.style.color = "#000000";
    }
    if (name.match(pattern_name))
    {
        form.classList.add("valid");
        form.classList.remove("invalid");
        text_name.innerHTML = "";
        text_name.style.color = "#0b00ab";
    }
    else
    {
        form.classList.remove("valid");
        form.classList.add("invalid");
        text_name.innerHTML = "Please Enter Valid Name";
        text_name.style.color = "#000000";
    }
}