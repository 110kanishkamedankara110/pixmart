function changeview() {
    var signin = document.getElementById("signin-box");
    var signup = document.getElementById("signup-box");

    signin.classList.toggle("d-none");
    signup.classList.toggle("d-none");


}

function signup() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");

    var f = new FormData();
    f.append("fname", fname.value);
    f.append("lname", lname.value);
    f.append("email", email.value);
    f.append("password", password.value);
    f.append("mobile", mobile.value);
    f.append("gender", gender.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;

            if (text == "Sucess") {
                changeview();
                fname.value = "";
                lname.value = "";
                email.value = "";
                password.value = "";
                mobile.value = "";
                document.getElementById("mass").innerHTML = "";
            } else {
                document.getElementById("mass").innerHTML = text;
            }

        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };
    r.open("POST", "signupprocess.php", true);
    r.send(f);



}

function signin() {
    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var remember = document.getElementById("remember");
    var remval = remember.value;
    var remche = remember.checked;

    var file = new FormData();
    file.append("email", email.value);
    file.append("password", password.value);
    file.append("remember", remche);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            if (text == "Sucess") {
                window.location = "home.php";
                email.value = "";
                password.value = "";
            } else {
                document.getElementById("mass2").innerHTML = text;

            }
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };
    r.open("POST", "signinprocess.php", true);
    r.send(file);
}



function fogetpassword() {
    var m = document.getElementById("fogetpassword");
    var nm = new bootstrap.Modal(m);
    var email = document.getElementById("email2");
    var f = new FormData();
    f.append("email", email.value);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            alert(text);
            if (text == 'Message has been sent.') {

                nm.show();
            } else {

            }

            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };
    r.open("POST", "fogetpasswordprocess.php", true);
    r.send(f);

}

function resetpw() {
    var email = document.getElementById("email2");
    var vc = document.getElementById("vc");
    var pw1 = document.getElementById("mp");
    var pw2 = document.getElementById("mp2");

    var f = new FormData();
    f.append("email", email.value);
    f.append("vc", vc.value);
    f.append("mp", pw1.value);
    f.append("mp2", pw2.value);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            alert(text);
            if (text == "Sucess") {
                alert("Password Reset Sucess");


                nm.hide();
            } else {
                alert(text);

            }

            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };
    r.open("POST", "changepassword.php", true);
    r.send(f);
}

function gotoaddproduct() {
    window.location = "addproduct.php";
}

function changeimage() {
    var image = document.getElementById("imguploader");
    var view = document.getElementById("prev");
    var imgdiv = document.getElementById("iii");

    image.onchange = function() {
        imgdiv.innerHTML = "<img class='productimg col-4 col-lg-2 ms-2' style='display:none' id='prev' src='recourses/add product page resources/addproductimg.svg' />";

        var childcount = imgdiv.childElementCount;
        if (childcount <= 3) {
            var filecount = this.files.length;
            if (filecount <= 3) {

                view.style.display = "none";

                for (var i = 0; i < filecount; i++) {
                    var newimgdisp = document.createElement("img");
                    newimgdisp.className = "productimg col-4 col-lg-2 ms-2";
                    var file = image.files[i];

                    var url = window.URL.createObjectURL(file);
                    newimgdisp.src = url;
                    imgdiv.appendChild(newimgdisp);
                }






            } else {
                alert("You Can Only Add 3 Images");
            }





        } else {
            alert("you cannot upload morethan 3 Images");
        }


        // var file = this.files[0];
        // var url = window.URL.createObjectURL(file);


        // view.src = url;





    }
}

function xyz() {
    alert("iweur");
}


function addproduct() {
    var catagory = document.getElementById("ca");
    var brand = document.getElementById("br");
    var model = document.getElementById("mo");
    var title = document.getElementById("ti");
    var condition;
    if (document.getElementById("bn").checked) {
        condition = 1;
    } else if (document.getElementById("us").checked) {
        condition = 2;
    }

    var color;
    if (document.getElementById("clr1").checked) {
        color = 1;
    } else if (document.getElementById("clr2").checked) {
        color = 2;
    } else if (document.getElementById("clr3").checked) {
        color = 3;
    } else if (document.getElementById("clr4").checked) {
        color = 4;
    } else if (document.getElementById("clr5").checked) {
        color = 5;
    } else if (document.getElementById("clr6").checked) {
        color = 6;
    }
    var qty = document.getElementById("qty");
    var price = document.getElementById("cost");
    var delevery_within_colombo = document.getElementById("dwc");
    var delevery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("des");
    var image = document.getElementById("imguploader");


    // alert(catagory.value);
    // alert(brand.value);
    // alert(model.value);
    // alert(title.value);
    // alert(condition);
    // alert(color);
    // alert(qty.value);
    // alert(price.value);
    // alert(delevery_within_colombo.value);
    // alert(delevery_outof_colombo.value);
    // alert(description.value);
    // alert(image.files[0]["name"]);

    var f = new FormData();
    f.append("c", catagory.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("t", title.value);
    f.append("co", condition);
    f.append("col", color);
    f.append("qty", qty.value);
    f.append("p", price.value);
    f.append("dwc", delevery_within_colombo.value);
    f.append("doc", delevery_outof_colombo.value);
    f.append("desc", description.value);
    for (var i = 0; i <= image.files.length; i++) {
        f.append("img" + i, image.files[i]);

    }


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            if (text == "sucess") {
                window.location = "addproduct.php";
            }
            alert(text);

            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    }
    r.open("POST", "addproductprocess.php", true);
    r.send(f);

}

function signout() {
    window.location = "signoutprocess.php";
}

function changeproductview() {
    var add = document.getElementById("addproductbox");
    var update = document.getElementById("updateproductbox");

    add.classList.toggle("d-none");
    update.classList.toggle("d-none");

}

function updateprofile() {
    var img = document.getElementById("profileimage");
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var email = document.getElementById("email");
    var addressline1 = document.getElementById("addressline1");
    var addressline2 = document.getElementById("addressline2");
    var city = document.getElementById("city");

    // alert(img.files["0"]["name"] + " " + fname.value + " " + lname.value + " " + mobile.value + " " + email.value +
    //     " " + addressline1.value + " " + addressline2.value + " " + city.value);
    var form = new FormData();

    form.append("img", img.files["0"]);

    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("mobile", mobile.value);
    form.append("email", email.value);
    form.append("addressline1", addressline1.value);
    form.append("addressline2", addressline2.value);
    form.append("city", city.value);

    var r = new XMLHttpRequest()
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            if (text == "sucess") {
                window.location = "userprofile.php";
            } else {
                alert(text);

            }
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };



    r.open("POST", "updateprofileprocess.php", true);
    r.send(form);


}

function chimg() {
    var img = document.getElementById("profileimage");
    var link = window.URL.createObjectURL(img.files[0]);
    document.getElementById("shdiv").src = link;
}

function changestatus(x, y, z) {


    var check = document.getElementById(y);
    var form = new FormData();
    if (check.checked) {
        stat = 1;
    } else {
        stat = 0;
    }
    form.append("status", stat);
    form.append("product", x);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;

            if (text == "Product Deactivated") {
                document.getElementById(z).innerHTML = "Make Your Product Active";
            } else {
                document.getElementById(z).innerHTML = "Make Your Product Deactive";
            }


            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };
    r.open("POST", "statuschangeprocess.php", true);
    r.send(form);
}


function deletemodel(x) {
    var del = document.getElementById("deletemodel");
    var k = new bootstrap.Modal(del);
    k.show();
    document.getElementById("delbut").setAttribute("onclick", "deleteproduct(" + x + ")");
}



function deleteproduct(y) {
    var form = new FormData();
    form.append("product", y);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            alert(text);
            if (text == "Sucess") {
                window.location = "sellerproductview.php";
            }


            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };
    r.open("POST", "deleteproductprocess.php", true);
    r.send(form);
}

function addfilters() {
    var search = document.getElementById("s").value;
    var fil;
    if (document.getElementById("n").checked) {
        fil = "new to old";
    } else if (document.getElementById("o").checked) {
        fil = "old to new";
    } else if (document.getElementById("l").checked) {
        fil = "low to high";
    } else if (document.getElementById("h").checked) {
        fil = "high to low";
    }
    var condition;
    if (document.getElementById("u").checked) {
        condition = "used";
    } else if (document.getElementById("bn").checked) {
        condition = "brandnew";
    } else {
        condition = "";
    }

    // alert(search);
    // alert(age);
    // alert(quentity);
    // alert(condition);
    var f = new FormData();
    f.append("search", search)
    f.append("fil", fil);

    f.append("condition", condition);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;

            document.getElementById("prodiv").innerHTML = text;
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };
    r.open("POST", "filterprocess.php", true);
    r.send(f);
}

function searchtoupdate() {
    var search = document.getElementById("search").value;
    var f = new FormData();
    f.append("search", search)

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;

            if (text == "cannot fount product") {
                alert(text);
                window.location = "updateproduct.php";
            } else if (text == "invalid id") {
                alert(text);
                window.location = "updateproduct.php";
            } else {
                var x = JSON.parse(text);
                var image = x["image0"];
                var catagory = x["catagory"];
                var model = x["model"];
                var brand = x["brand"];
                var title = x["title"];
                var condition = x["condition"];
                var color = x["color"];
                var qty = x["qty"];
                var price = x["price"];
                var dfc = x["dfc"];
                var dfo = x["dfo"];
                var description = x["description"];
                var id = x["id"];
                for (var i = 1; i <= 2; i++) {
                    if ("image" + i in x) {
                        var imgdiv = document.getElementById("iii");
                        var newimgdisp = document.createElement("img");
                        newimgdisp.className = "productimg col-4 col-lg-2 ms-2";
                        var imgg = "image" + i;


                        newimgdisp.src = x[imgg];
                        imgdiv.appendChild(newimgdisp);


                    }
                }

                // alert(image);
                // alert(brand);
                // alert(model);
                // alert(catagory);
                // alert(title);
                // alert(condition);
                // alert(color);
                // alert(qty);
                // alert(dfc);
                // alert(dfo);
                // alert(description);
                document.getElementById("ca").value = catagory;
                document.getElementById("bra").innerHTML = brand;
                document.getElementById("moa").innerHTML = model;
                document.getElementById("br").value = brand;
                document.getElementById("mo").value = model;
                document.getElementById("ti").value = title;
                document.getElementById("up").setAttribute("onclick", "updateprocess(" + id + ")");
                if (condition == "brandnew") {
                    document.getElementById("bn").setAttribute("checked", "checked");
                } else {
                    document.getElementById("us").setAttribute("checked", "checked");
                }


                if (color == "gold") {
                    document.getElementById("clr1").setAttribute("checked", "checked");
                } else if (color == "Silver") {
                    document.getElementById("clr2").setAttribute("checked", "checked");
                } else if (color == "Graphite") {
                    document.getElementById("clr3").setAttribute("checked", "checked");
                } else if (color == "Pacific Blue") {
                    document.getElementById("clr4").setAttribute("checked", "checked");
                } else if (color == "Rose Gold") {
                    document.getElementById("clr5").setAttribute("checked", "checked");
                } else if (color == "Jet Black") {
                    document.getElementById("clr6").setAttribute("checked", "checked");
                }
                document.getElementById("qty").value = qty;
                document.getElementById("cost").value = price;
                document.getElementById("dwc").value = dfc;
                document.getElementById("doc").value = dfo;
                document.getElementById("des").value = description;
                document.getElementById("prev").src = image;


            }
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };
    r.open("POST", "updateproductprocess.php", true);
    r.send(f);
}

function clr() {
    document.getElementById("s").value = "";
    document.getElementById("n").checked = false;
    document.getElementById("o").checked = false;
    document.getElementById("l").checked = false;
    document.getElementById("h").checked = false;
    document.getElementById("u").checked = false;
    document.getElementById("bn").checked = false;
}

function updateprocess(x) {

    var title = document.getElementById("ti");
    var qty = document.getElementById("qty");

    var delevery_within_colombo = document.getElementById("dwc");
    var delevery_outof_colombo = document.getElementById("doc");
    var description = document.getElementById("des");
    var image = document.getElementById("imguploader");



    // alert(title.value);

    // alert(qty.value);

    // alert(delevery_within_colombo.value);
    // alert(delevery_outof_colombo.value);
    // alert(description.value);
    // alert(image.files[0]["name"]);

    var f = new FormData();

    f.append("t", title.value);
    f.append("pro", x);
    f.append("qty", qty.value);

    f.append("dwc", delevery_within_colombo.value);
    f.append("doc", delevery_outof_colombo.value);
    f.append("desc", description.value);
    for (var i = 0; i <= image.files.length; i++) {
        f.append("img" + i, image.files[i]);

    }


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            if (text == "sucess") {
                window.location = "sellerproductview.php";
            }
            alert(text);

            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    }
    r.open("POST", "proupprocess.php", true);
    r.send(f);
}

function bm(x) {

    document.getElementById("bm").setAttribute("style", "background-image: url('" + x + "')");
}

function up(x, y) {
    var qtyup = "qty" + y;

    var val = document.getElementById(qtyup).value;
    if (val < x) {
        document.getElementById(qtyup).value = val - (-1);
    } else {
        alert("Max Quantity has Arrived");
    }
}

function down(x) {
    var qtyup = "qty" + x;
    var val = document.getElementById(qtyup).value;
    if (val > 1) {
        document.getElementById(qtyup).value = val - (1);
    }
}

function basic_search() {
    var search = document.getElementById("basic_search_search").value;
    var select = document.getElementById("basic_search_select").value;
    var f = new FormData();
    f.append("search", search);
    f.append("select", select);
    f.append("page", 1);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            document.getElementById("proview").innerHTML = text;
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };
    r.open("POST", "basicsearchprocess.php", true);
    r.send(f);

}

function pagin(x) {
    var search = document.getElementById("basic_search_search").value;
    var select = document.getElementById("basic_search_select").value;
    var f = new FormData();
    f.append("search", search);
    f.append("select", select);
    f.append("page", x);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            document.getElementById("proview").innerHTML = text;
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };
    r.open("POST", "basicsearchprocess.php", true);
    r.send(f);

}

function addwatchlist(x) {
    // alert(x);
    var h = "heart" + x;


    var f = new FormData();
    f.append("id", x);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            if (text == "poe") {
                document.getElementById(h).className = "bi bi-heart";
            } else {
                document.getElementById(h).className = "bi bi-heart-fill";
            }

            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };
    r.open("POST", "addwatchlist.php", true);
    r.send(f);
}

function addwatchlist2(x) {
    // alert(x);



    var f = new FormData();
    f.append("id", x);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            window.location = "watchlist.php";
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };
    r.open("POST", "addwatchlist.php", true);
    r.send(f);
}

function searchwishlist() {
    var search = document.getElementById("search").value;

    var f = new FormData();
    f.append("search", search);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            document.getElementById("wishlistproview").innerHTML = text;
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };
    r.open("POST", "wishlistsearch.php", true);
    r.send(f);

}

function showall(x) {

    var f = new FormData();

    f.append("cat", x);
    f.append("page", 1);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            document.getElementById("proview").innerHTML = text;
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };
    r.open("POST", "showall.php", true);
    r.send(f);

}

function pagin2(x, y) {

    var f = new FormData();

    f.append("cat", y);
    f.append("page", x);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            document.getElementById("proview").innerHTML = text;
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };
    r.open("POST", "showall.php", true);
    r.send(f);

}

function addtocart(x, y) {
    var i = "qty" + x;
    var qty = document.getElementById(i).value;
    if (qty == 0) {
        alert("Select Quantity first");
    } else if (qty > y) {
        alert("invalid quantiy (Only " + y + " item(s) left )");
    } else {
        var f = new FormData();
        f.append("id", x);
        f.append("qty", qty);

        var r = new XMLHttpRequest();
        r.onreadystatechange = function() {
            if (r.readyState == 4) {
                document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
                var text = r.responseText;
                alert(text);
                document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            } else {
                document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
            }
        };
        r.open("POST", "addtocart.php", true);
        r.send(f);

    }

}

function addtocart2(x, y) {

    var f = new FormData();
    f.append("id", x);
    f.append("qty", 1);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            alert(text);
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };
    r.open("POST", "addtocart.php", true);
    r.send(f);

}




function cart() {
    window.location = "cart.php";
}

// function editcart(x, y) {
//     var i = "qty" + x;
//     var qty = document.getElementById(i).value;
//     if (qty == 0) {
//         alert("Select Quantity first");
//     } else if (qty > y) {
//         alert("invalid quantiy (Only " + y + " item(s) left )");
//     } else {
//         alert("ok");
//         // var f = new FormData();
//         // f.append("id", x);
//         // f.append("qty", qty);

//         // var r = new XMLHttpRequest();
//         // r.onreadystatechange = function() {
//         //     if (r.readyState == 4) {
//         //         var text = r.responseText;
//         //         alert(text);
//         //     }
//         // }
//         // r.open("POST", "addtocart.php", true);
//         // r.send(f);

//     }

// }
function removecart(x) {
    var f = new FormData();
    f.append("id", x);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            window.location = "cart.php";
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };
    r.open("POST", "removecart.php", true);
    r.send(f);
}

function searchcart() {
    var x = document.getElementById("search").value
    var f = new FormData();
    f.append("key", x);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            document.getElementById("show").innerHTML = text;
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };
    r.open("POST", "cartsearch.php", true);
    r.send(f);
}

function paynow(x) {
    var id = x;
    var inp = "qty" + x;
    var qty = document.getElementById(inp).value;
    var f = new FormData();
    f.append("id", id);
    f.append("qty", qty)

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {

            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            if (text == "1") {
                window.location = "index.php";
            } else if (text == "2") {
                window.location = "userprofile.php";
            } else {
                var array = JSON.parse(text);




                // Called when user completed the payment. It can be a successful payment or failure
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                    saveinvoice(array["orderID"], x, array["qty"], array["email"], array["amount"]);
                };

                // Called when user closes the payment without completing
                payhere.onDismissed = function onDismissed() {
                    //Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Called when error happens when initializing payment such as invalid parameters
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1218964", // Replace your Merchant ID
                    "return_url": "singleproduct.php?id =" + x, // Important
                    "cancel_url": "singleproduct.php?id =" + x, // Important
                    "notify_url": "notify.php",
                    "order_id": array["orderID"],
                    "items": array["item"],
                    "amount": array["amount"],
                    "currency": "LKR",
                    "first_name": array["first_name"],
                    "last_name": array["last_name"],
                    "email": array["email"],
                    "phone": array["phone"],
                    "address": array["address"],
                    "city": array["city"],
                    "country": "Sri Lanka",
                    "delivery_address": array["address"],
                    "delivery_city": array["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": "",

                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked

                payhere.startPayment(payment);


            }
        }
    };
    r.open("POST", "byunowprocess.php", true);
    r.send(f);
}

function saveinvoice(orderid, proid, qty, email, amount) {
    var order_id = orderid;
    var product_id = proid;
    var quantity = qty;
    var mail = email;
    var orderamount = amount;

    // alert(order_id);
    // alert(product_id);
    // alert(quantity);
    // alert(mail);

    // alert(orderamount);


    var f = new FormData();
    f.append("pro_id", product_id);
    f.append("order_id", order_id);
    f.append("qty", quantity);
    f.append("mail", mail);
    f.append("amount", orderamount);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            alert(text);

            window.location = "invoice.php?id=" + order_id;

            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };
    r.open("POST", "saveinvoice.php", true);
    r.send(f);


}

function detailsmodel(x) {
    alert(x);
}

function printDiv() {
    // var divContents = document.getElementById("GFG").innerHTML;
    // var a = window.open('', '', 'height=500, width=500');
    // a.document.write('<html>');
    // a.document.write('<body > <h1>Div contents are <br>');
    // a.document.write(divContents);
    // a.document.write('</body></html>');
    // a.document.close();
    // a.print();


    // var restorepage = document.body.innerHTML;
    // var page = document.getElementById("page").innerHTML;
    // document.body.innerHTML = page;
    // window.print();
    // document.body.innerHTML = restorepage;

    var pg = document.getElementById("page").innerHTML;
    var pre = document.getElementById("body").innerHTML;
    document.getElementById("body").innerHTML = pg;
    window.print();
    document.getElementById("body").innerHTML = pre;



}

function AddFeedBack(id) {
    var i = id;
    var modal = document.getElementById("addFeedbackmodal" + i);
    nm = new bootstrap.Modal(modal);
    nm.show();



}

function SaveFeedBack(id) {
    var pid = id;
    var tex = "feedtext" + pid
    var feedtxt = document.getElementById(tex).value;

    var f = new FormData();
    f.append("i", pid);
    f.append("ft", feedtxt);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            if (text == "1") {
                window.location = "tranceactionhistory.php";
            }
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }

    };

    r.open("POST", "savefeed_proc.php", true);
    r.send(f);
}

function ref() {
    window.location = "tranceactionhistory.php";
}

function pop(x) {
    var id = "pop" + x;
    document.getElementById(id).className = "tol rounded col-12 p-2"
}

function pop2(x) {
    var id = "pop" + x;
    document.getElementById(id).className = "tol rounded col-12 p-2 d-none"
}

function adminverification() {
    var email = document.getElementById("e").value;

    var f = new FormData();
    f.append("email", email);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            if (text == "success") {

                var VerificationModal = document.getElementById("VerificationModal");
                k = new bootstrap.Modal(VerificationModal)
                k.show();

            } else {
                alert(text);
            }
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }

    };

    r.open("POST", "admin_verification_proccess.php", true);
    r.send(f);
}

function Verify() {
    var vcode = document.getElementById("v").value;

    var f = new FormData();
    f.append("vcode", vcode);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            if (text == "success") {

                var VerificationModal = document.getElementById("VerificationModal");
                k = new bootstrap.Modal(VerificationModal)
                k.hide();
                window.location = "adminpannel.php";

            } else {
                alert(text);
            }
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }

    };
    r.open("POST", "Verify_codeproc.php", true);
    r.send(f);
}


function act() {
    setInterval(timetime, 600);
}

function timetime() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {

            var text = r.responseText;
            document.getElementById("timetime").innerHTML = text;
        }

    }
    r.open("POST", "timetime.php", true);
    r.send();
}

function blockuser(x) {
    var f = new FormData();
    f.append("email", x);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            if (text == "blocked") {
                var id = "btn" + x;
                document.getElementById(id).innerHTML = "Unblock";
                document.getElementById(id).className = "btn btn-success";
            } else {
                var id = "btn" + x;
                document.getElementById(id).innerHTML = "Block";
                document.getElementById(id).className = "btn btn-danger";
            }
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }

    };
    r.open("POST", "blockuser.php", true);
    r.send(f);
}

function ussearch() {
    var se = document.getElementById("ussearch").value;

    var f = new FormData();
    f.append("search", se);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            document.getElementById("users").innerHTML = text;

            document.getElementById("pag").className = "d-none";
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }

    };
    r.open("POST", "searchuser.php", true);
    r.send(f);
}

function checkout() {




    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;




            if (text == "1") {
                window.location = "index.php";
            } else if (text == "2") {
                window.location = "userprofile.php";
            } else {
                var data = JSON.parse(text);

                // Called when user completed the payment. It can be a successful payment or failure
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                    //Note: validate the payment and show success or failure page to the customer
                    saveinvoicecart(data["orderid"]);
                };

                // Called when user closes the payment without completing
                payhere.onDismissed = function onDismissed() {
                    //Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Called when error happens when initializing payment such as invalid parameters
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1218964", // Replace your Merchant ID
                    "return_url": "cart.php", // Important
                    "cancel_url": "cart.php", // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": data["orderid"],
                    "items": data["items"],
                    "amount": data["totpri"],
                    "currency": "LKR",
                    "first_name": data["fname"],
                    "last_name": data["lname"],
                    "email": data["email"],
                    "phone": data["mobile"],
                    "address": data["address"],
                    "city": data["city"],
                    "country": "Sri Lanka",
                    "delivery_address": data["address"],
                    "delivery_city": data["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked

                payhere.startPayment(payment);

            }
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }

    };
    r.open("POST", "checkout.php", true);
    r.send();
}

function saveinvoicecart(orderid) {
    var order_id = orderid;

    // alert(order_id);
    // alert(product_id);
    // alert(quantity);
    // alert(mail);

    // alert(orderamount);
    // alert(order_id);

    var f = new FormData();

    f.append("order_id", order_id);
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            alert(text);

            window.location = "invoice.php?id=" + order_id;

            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };
    r.open("POST", "saveinvoicecart.php", true);
    r.send(f);
}

function advsearch(x) {

    var keyword = document.getElementById("k").value;
    var catagory = document.getElementById("c").value;
    var brand = document.getElementById("b").value;
    var model = document.getElementById("m").value;
    var condition = document.getElementById("con").value;
    var color = document.getElementById("colo").value;
    var pricefrom = document.getElementById("pf").value;
    var priceto = document.getElementById("pt").value;

    // alert(keyword);
    // alert(catagory);
    // alert(brand);
    // alert(model);
    // alert(condition);
    // alert(color);
    // alert(pricefrom);
    // alert(priceto);
    var f = new FormData();
    f.append("page", x);
    f.append("k", keyword);
    f.append("c", catagory);
    f.append("b", brand);
    f.append("m", model);
    f.append("con", condition);
    f.append("colo", color);
    f.append("pf", pricefrom);
    f.append("pt", priceto);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            document.getElementById("disp").innerHTML = text;



            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };
    r.open("POST", "advancesearchprocess.php", true);
    r.send(f);
}

function dailysellings() {
    var fromdate = document.getElementById("fromdate").value;
    var todate = document.getElementById("todate").value;
    var link = document.getElementById("historylink");

    window.location = "sellinghistory.php?f=" + fromdate + "&t=" + todate;
}

function viewmassagemodel(email) {
    var id = "massageModal" + email;
    var model = document.getElementById(id);
    k = new bootstrap.Modal(model);
    k.show();
}

function addnewmodel() {
    var m = new bootstrap.Modal(document.getElementById("addnew"));
    m.show();
}

function addcat() {
    var catagory = document.getElementById("cat").value;

    var f = new FormData();
    f.append("catagory", catagory);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;


            var m = new bootstrap.Modal(document.getElementById("addnew"));
            m.hide();
            window.location = "manageproduct.php";


            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }
    };
    r.open("POST", "addcatagory.php", true);
    r.send(f);


}

function blockproduct(x) {
    var f = new FormData();
    f.append("id", x);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;

            if (text == "blocked") {
                var id = "btn" + x;
                document.getElementById(id).innerHTML = "Unblock";
                document.getElementById(id).className = "btn btn-success";
            } else {
                var id = "btn" + x;
                document.getElementById(id).innerHTML = "Block";
                document.getElementById(id).className = "btn btn-danger";
            }
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }

    };
    r.open("POST", "blockproduct.php", true);
    r.send(f);
}

function prosearch() {
    var se = document.getElementById("prosearch").value;

    var f = new FormData();
    f.append("search", se);
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            document.getElementById("products").innerHTML = text;
            document.getElementById("pag").className = "d-none";
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }

    };
    r.open("POST", "searchproduct.php", true);
    r.send(f);
}

function prodet(id) {
    var id = "singleproview" + id;
    var n = new bootstrap.Modal(document.getElementById(id));
    n.show();
}

function seluser(x) {
    var r = new XMLHttpRequest();
    var f = new FormData();
    f.append("user", x);


    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
            var text = r.responseText;
            document.getElementById("chatbox").innerHTML = text;
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-none";
        } else {
            document.getElementById("load").className = "align-items-center justify-content-center position-absolute d-flex";
        }

    };
    r.open("POST", "selusermassage.php", true);
    r.send(f);
}

function refresh() {
    setInterval(rf, 2000);
    setInterval(rfres, 2000);
}

function rf() {
    // alert("working")
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("chatbox").innerHTML = text;
        }

    }
    r.open("POST", "selusermassage.php", true);
    r.send();
}

function rfres() {
    // alert("working")
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("massagebox").innerHTML = text;
        }

    }
    r.open("POST", "resentrefresh.php", true);
    r.send();
}

function sendmassage() {
    var txt = document.getElementById("ms").value;
    var f = new FormData();
    f.append("massage", txt);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("ms").value = "";
            rf();


        }

    }
    r.open("POST", "sendmassage.php", true);
    r.send(f);
}

function sendmassage2(x) {
    var id = "ms" + x;
    var txt = document.getElementById(id).value;
    var f = new FormData();
    f.append("massage", txt);
    f.append("us", x);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById(id).value = "";
            rf2(x);

        }

    }
    r.open("POST", "sendmassage2.php", true);
    r.send(f);
}

function refresh2(x) {
    setInterval(rf2, 2000, x);

}

function rf2(x) {
    var f = new FormData();
    f.append("us", x);
    // alert("working")
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        var id = "chatbox" + x;
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById(id).innerHTML = text;

        }

    }
    r.open("POST", "selusermassage2.php", true);
    r.send(f);
}