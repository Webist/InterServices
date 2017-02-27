<?php

namespace App\Handler;


use App\Spec\Database;

class MainHandler extends Service implements Database
{
    private $route = [];

    public function __construct(array $route)
    {
        $this->route = $route;

        $this->logVisit([
            'routeId' => $this->route['indexKey'], 'ip' => filter_input(INPUT_SERVER, 'REMOTE_ADDR')
        ]);
    }

    public function route()
    {
        return $this->route;
    }

    private function logVisit(array $params)
    {
        // Non-blocking, db logging
        $visitsLoggerQuery = function($pdo) use ($params) {

            $query = "INSERT INTO visits SET route_id = :routeId, ip = :ip";
            $dbh = $pdo->prepare($query);
            return $dbh->execute(
                [':routeId' => $params['routeId'], ':ip' => $params['ip']]
            );
        };

        /** @var \App\Service\Database $db */
        $db = $this->service(self::DATABASE, $visitsLoggerQuery);
        $db->handle( dirname(__DIR__) . self::DATABASE_LOGS_CREDENTIALS_FILE);
    }


    /**
     * Generic body content builder
     *
     * @param string $placeHolder
     * @param $content
     * @return \Html\Composite
     */
    function buildContentWith(string $placeHolder, $content)
    {
        /**
         * File Storage data is useful for meta data.
         *
         * For example html page title.
         */
        //----  File Storage data
        $appData = include '../app/Data/' . $this->route()['indexKey'].'.php';

        /**
         * Info: Every node requires data-object (entity/operand).
         * When no ORM entity, then there should be a data-object created.
         * For example \Html\HeadData to provide data to head tags of html document.
         */

        $headData = new \Html\HeadData();
        $headData->setTitle($appData['head']['title']);

        $htmlHead = new \Html\Element($headData);
        $htmlHead->require('../metronic/html.head.php');

        $bodyData = new \Html\BodyData();
        $bodyData->setTitle($appData['body']['title']);

        $bodyContent = new \Html\Element($bodyData);
        $bodyContent->require('../metronic/html.page.php');

        $pageHeader = new \Html\Element($bodyData);
        $pageHeader->require('../metronic/html.page.header.php');

        /* ---- DO NOT REMOVE THE temp DISABLED CONTENT BELOW ---- */
        // subcontent
        // $pageActions = new \Html\Element($bodyData);
        // $pageActions->require('../metronic/html.page.actions.php');
        // $pageHeader->addElement(':pageActions', $pageActions);

        // $searchBox = new \Html\Element($bodyData);
        // $searchBox->require('../metronic/html.page.searchbox.php');
        // $pageHeader->addElement('pageSearchBox', $searchBox);

        // $notificationDropDown = new \Html\Element($bodyData);
        // $notificationDropDown->require('../metronic/html.page.notification.dropdown.php');
        // $pageHeader->addElement(':pageNotificationDropdown', $notificationDropDown);

        // $inboxDropDown = new \Html\Element($bodyData);
        // $inboxDropDown->require('../metronic/html.page.inbox.dropdown.php');
        // $pageHeader->addElement(':pageInboxDropDown', $inboxDropDown);

        // $tasksDropDown = new \Html\Element($bodyData);
        // $tasksDropDown->require('../metronic/html.page.tasks.dropdown.php');
        // $pageHeader->addElement(':pageTasksDropDown', $tasksDropDown);

        // $userLogin = new \Html\Element($bodyData);
        // $userLogin->require('../metronic/html.page.user.login.dropdown.php');
        // $pageHeader->addElement(':pageUserLoginDropDown', $userLogin);

        $bodyContent->addElement(':pageHeader', $pageHeader);

        $pageSideBar = new \Html\Element($bodyData);
        $pageSideBar->require('../metronic/html.page.sidebar.php');
        $bodyContent->addElement(':pageSidebar', $pageSideBar);

        // $pageHead = new \Html\Element($bodyData);
        // $pageHead->require('../metronic/html.page.head.php');
        // $bodyContent->addElement(':pageHead', $pageHead);

        $breadCrumb = new \Html\Element($bodyData);
        $breadCrumb->require( '../metronic/html.page.breadcrumb.php');
        $bodyContent->addElement(':pageBreadCrumb',$breadCrumb);

        $scripts = new \Html\Element($bodyData);
        $scripts->require('../metronic/html.page.scripts.php');
        $bodyContent->addElement(':pageScripts', $scripts);

        // $quickSidebar = new \Html\Element($bodyData);
        // $quickSidebar->require('../metronic/html.page.quick.sidebar.php');
        // $bodyContent->addElement(':pageQuickSideBar', $quickSidebar);

        // $quickNav = new \Html\Element($bodyData);
        // $quickNav->require('../metronic/html.page.quick.nav.php');
        // $bodyContent->addElement(':pageQuickNav', $quickNav);

        $bodyContent->addElement($placeHolder, $content);

        $lay = new \Html\Composite();
        $lay->setHeadContent($htmlHead);
        $lay->addElement($bodyContent);
        return $lay;
    }
}