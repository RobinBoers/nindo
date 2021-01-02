<?php
    session_start();
?>
<!DOCTYPE html>
<!--<html manifest="all.appcache">-->
<html>
<head>
    <!-- METATAGS -->
    <title>Nindo</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="manifest" href="manifest.json">
    <link rel="shortcut icon" href="/logo2.png" type="image/png" />
    
    <!-- Onsen UI -->
    <link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsenui.css">
    <link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsen-css-components.min.css">
    <script src="https://unpkg.com/onsenui/js/onsenui.min.js"></script>
    
    <link rel="apple-touch-icon" sizes="64x64" href="logo2.png">
    <link rel="apple-touch-icon" sizes="48x48" href="logo3.png">
    <link rel="apple-touch-icon" sizes="128x128" href="logo4.ico">
    <link rel="apple-touch-icon" sizes="16x16" href="logo4.png">
    
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="true">
    <meta name="MobileOptimized" content="width">
    
    <script>
        addEventListener("load", function() {
            setTimeout(hideURLbar,0);
        }, false);
        
        function hideURLbar() {
            window.scrollTo(0,1);
        }
    </script>
    
</head>
<!--

===========================
Copyright Robin Boers
This is a part of DGAW
===========================

-->
<body>
    <main>
        <article class="inlogvak">
            <?php
            if($_SESSION['login19'] == false) {
                include "inloggen.php";
            } else {
                ?>
            
            <ons-page>
<!--
              <ons-toolbar>
                <div class="center">DGAW</div>
              </ons-toolbar>
-->

              <ons-tabbar position="auto"><!-- swipeable -->
                <ons-tab page="start.php" label="Nindo" icon="fa-home" active>
                </ons-tab>
                <ons-tab page="friends.php" label="Friends" icon="fa-user-friends">
                </ons-tab>
                <ons-tab page="inbox.php" label="Inbox" icon="md-edit">
                </ons-tab>
                <ons-tab page="chat.php" label="Chat" icon="fa-comments">
                </ons-tab>
                <ons-tab page="menu.php" label="Menu" icon="md-settings">
                </ons-tab>
              </ons-tabbar>
            </ons-page>
           
            <template id="start.php">
              <ons-page id="Nindo">
                <ons-toolbar>
                    <div class="center">Nindo</div>
                    <div class="right">
                        <ons-toolbar-button onclick="openNav()">
                            <ons-icon class="menuBtn22" icon="ion-navicon, material:md-menu"></ons-icon>
                        </ons-toolbar-button>
                    </div>
                </ons-toolbar>
                <p style="text-align: center;">
                  <?php
                    include "start.php";
                    ?>
                </p>
              </ons-page>
            </template>
            
            <template id="menu.php">
              <ons-page id="Menu">
                <ons-toolbar>
                    <div class="center">Menu</div>
                    <div class="right">
                    </div>
                </ons-toolbar>
                 <ons-list>
                    <ons-list-item onclick="logout()" tappable>
                        Uitloggen
                    </ons-list-item>
                    <ons-list-item onclick="profile()" tappable>
                        Profiel
                    </ons-list-item>
                    <ons-list-item onclick="window.location = 'about.php';" tappable>
                        Over deze app
                    </ons-list-item>
                    <ons-list-item onclick="window.location = 'terms.php';" tappable>
                        Gebruikersvoorwaarden
                    </ons-list-item>
                    <ons-list-item onclick="window.location = '?platform=android'" platform="android" tappable>
                        Android
                    </ons-list-item>
                     
                </ons-list>
              </ons-page>
            </template>

            <template id="friends.php">
              <ons-page id="Friends">
                <ons-toolbar>
                    <div class="center">Vrienden</div>
                    <div class="right">
                        <ons-toolbar-button onclick="openNav()">
                            <ons-icon class="menuBtn22" icon="ion-navicon, material:md-menu"></ons-icon>
                        </ons-toolbar-button>
                    </div>
                </ons-toolbar>
                <p style="text-align: center;">
                  <?php
                    include "friends.php";
                    ?>
                </p>
              </ons-page>
            </template>
            
            <template id="inbox.php">
              <ons-page id="Inbox">
                <ons-toolbar>
                    <div class="center">Berichten</div>
                    <div class="right">
                        <ons-toolbar-button onclick="openNav()">
                            <ons-icon class="menuBtn22" icon="ion-navicon, material:md-menu"></ons-icon>
                        </ons-toolbar-button>
                    </div>
                </ons-toolbar>
                <p style="text-align: center;">
                  <?php
                    include "inbox.php";
                    ?>
                </p>
              </ons-page>
            </template>
            
            <template id="chat.php">
              <ons-page id="Chat">
                <ons-toolbar>
                    <div class="center">Chatten</div>
                    <div class="right">
                        <ons-toolbar-button onclick="openNav()">
                            <ons-icon class="menuBtn22" icon="ion-navicon, material:md-menu"></ons-icon>
                        </ons-toolbar-button>
                    </div>
                </ons-toolbar>
                <p style="text-align: center;">
                  <?php
                    include "chat.php";
                    ?>
                </p>
              </ons-page>
            </template>
            
            
                <?php
            }
            ?>
        </article>
    </main>
    <?php
        include "head.php";
    ?>
</body>
</html>