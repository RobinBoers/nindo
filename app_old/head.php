<script>
    function logout() {
        window.location = "/account/uitloggen.php";
//        window.location = "/geheimesite.nl/dgaw/app/logout.php";
    }
        
    var showAlert = function(message) {
      ons.notification.alert(message);
    };

    var showConfirm = function(message) {
      ons.notification.confirm(message)
    };

    var showPrompt = function(message) {
      ons.notification.prompt(message)
        .then(function(input) {
          var message = input ? 'Entered: ' + input : 'Entered nothing!';
          ons.notification.alert(message);
        });
    };

    var showToast = function(message, time) {
      ons.notification.toast(message, {
        timeout: time
      });
    };
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }
    </script>
    
    <style>
        .page__content {
            overflow-x: hidden !important;
/*            padding: 10px;*/
        }
        .page {overflow-x: hidden !important;padding: 10px;}
        html {
          -webkit-box-sizing: border-box;
          -moz-box-sizing: border-box;
          box-sizing: border-box;
        }
        *, *:before, *:after {
          -webkit-box-sizing: inherit;
          -moz-box-sizing: inherit;
          box-sizing: inherit;
        } a {color: royalblue;text-decoration: none;}

        .sidenav {
          height: 100%;
          width: 0;
          position: fixed;
          z-index: 1;
          top: 0;
          right: 0;
          background-color: darkgray;
          overflow-x: hidden;
          transition: 0.5s;
          padding-top: 60px;
        }

        .sidenav a {
          padding: 8px 8px 8px 32px;
          text-decoration: none;
          font-size: 25px;
          color: royalblue;
          display: block;
          transition: 0.3s;
        }

        .sidenav .closebtn {
          position: absolute;
          top: 0;
          right: 25px;
          font-size: 36px;
          margin-left: 50px;
        }

        @media screen and (max-height: 450px) {
          .sidenav {padding-top: 15px;}
          .sidenav a {font-size: 18px;}
        }
    </style>