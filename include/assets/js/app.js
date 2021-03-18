$(document).ready(function () {
  hljs.highlightAll();

  if (getCookie("show-code") == "false") {
    $("#show-code-option-check").prop("checked", false);
    $("#code").css("margin-left", "100%");
    $("#canvas").css("width", "100%");
  }

  if (getCookie("darkmode") == "true") {
    $("#darkmode-option-check").prop("checked", true);
    $("#content").css("background-color", "#1e1e1e");
    $('link[href="include/assets/css/code.css"]').attr(
        "href",
        "include/assets/css/code-darkmode.css"
      );
  }

  $("#show-code-option").click(function () {
    if ($("#show-code-option-check").is(":checked")) {
      $("#code").animate({ marginLeft: "66.67%" }, 500);
      $("#canvas").animate({ width: "66.67%" }, 500);
      setCookie("show-code", "true", 365);
    } else {
      $("#code").animate({ marginLeft: "100%" }, 500);
      $("#canvas").animate({ width: "100%" }, 500);
      setCookie("show-code", "false", 365);
    }
  });

  $("#darkmode-option").click(function () {
    if ($("#darkmode-option-check").is(":checked")) {
      $("#content").css("background-color", "#1e1e1e");
      $('link[href="include/assets/css/code.css"]').attr(
        "href",
        "include/assets/css/code-darkmode.css"
      );
      setCookie("darkmode", "true", 365);
    } else {
      $("#content").css("background-color", "#ffffff");
      $('link[href="include/assets/css/code-darkmode.css"]').attr(
        "href",
        "include/assets/css/code.css"
      );
      setCookie("darkmode", "false", 365);
    }
  });
});

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
  var expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(";");

  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
