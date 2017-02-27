<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="/">
                <img src="" alt="logo" class="logo-default" /> </a>
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN PAGE ACTIONS -->
        <?php /* :pageActions */ ?>
        <!-- END PAGE ACTIONS -->
        <!-- BEGIN PAGE TOP -->
        <div class="page-top">
            <!-- BEGIN HEADER SEARCH BOX -->
            <?php /* :pageSearchBox */ ?>
            <!-- END HEADER SEARCH BOX -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <?php /* :pageNotificationDropdown */ ?>
                    <!-- END NOTIFICATION DROPDOWN -->
                    <!-- BEGIN INBOX DROPDOWN -->
                    <?php /* :pageInboxDropDown */ ?>
                    <!-- END INBOX DROPDOWN -->
                    <!-- BEGIN TASKS DROPDOWN -->
                    <?php /* :pageTasksDropDown */ ?>
                    <!-- END TASKS DROPDOWN -->
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <?php /* :pageUserLoginDropDown */ ?>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <?php /*
                    <li class="dropdown dropdown-extended quick-sidebar-toggler">
                        <span class="sr-only">Toggle Quick Sidebar</span>
                        <i class="icon-logout"></i>
                    </li> */ ?>
                    <!-- END QUICK SIDEBAR TOGGLER -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>
<?php
