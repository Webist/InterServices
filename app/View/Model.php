<?php


namespace View;


class Model
{
    /**
     * Content data
     * @var \Html\Element
     */
    private $templateData;

    /**
     * Meta data, other than content data, such as title, keywords
     * @var array
     */
    private $pageMetaData;

    public function __construct(\Html\Element $templateData, array $pageMetaData)
    {
        $this->templateData = $templateData;
        $this->pageMetaData = $pageMetaData;
    }

    /**
     * @param bool $withBaseContent current template will be wrapped with baseContent
     * @return mixed|string
     */
    public function render($withBaseContent = true)
    {
        if($withBaseContent) {
            $content = $this->buildContentWith(':pageBaseContent', $this->templateData);
            return $content->render();
        }

        return $this->templateData->render();
    }


    /**
     * Generic html body content builder to reuse together with a specific body content
     *
     * @param string $placeHolder
     * @param \Html\Element $content
     * @return \Html\Composite
     */
    private function buildContentWith(string $placeHolder, \Html\Element $content)
    {
        $headData = new \Html\HeadData();
        $headData->setTitle($this->pageMetaData['head']['title']);

        $htmlHead = new \Html\Element($headData);
        $htmlHead->require('../web/metronic/html.head.php');

        $bodyData = new \Html\BodyData();
        $bodyData->setTitle($this->pageMetaData['body']['title']);

        $bodyContent = new \Html\Element($bodyData);
        $bodyContent->require('../web/metronic/html.page.php');

        $pageHeader = new \Html\Element($bodyData);
        $pageHeader->require('../web/metronic/html.page.header.php');

        /* ---- DO NOT REMOVE THE temp DISABLED CONTENT BELOW ---- */
        // subcontent
        // $pageActions = new \Html\Element($bodyData);
        // $pageActions->require('../web/metronic/html.page.actions.php');
        // $pageHeader->addElement(':pageActions', $pageActions);

        // $searchBox = new \Html\Element($bodyData);
        // $searchBox->require('../web/metronic/html.page.searchbox.php');
        // $pageHeader->addElement('pageSearchBox', $searchBox);

        // $notificationDropDown = new \Html\Element($bodyData);
        // $notificationDropDown->require('../web/metronic/html.page.notification.dropdown.php');
        // $pageHeader->addElement(':pageNotificationDropdown', $notificationDropDown);

        // $inboxDropDown = new \Html\Element($bodyData);
        // $inboxDropDown->require('../web/metronic/html.page.inbox.dropdown.php');
        // $pageHeader->addElement(':pageInboxDropDown', $inboxDropDown);

        // $tasksDropDown = new \Html\Element($bodyData);
        // $tasksDropDown->require('../web/metronic/html.page.tasks.dropdown.php');
        // $pageHeader->addElement(':pageTasksDropDown', $tasksDropDown);

        // $userLogin = new \Html\Element($bodyData);
        // $userLogin->require('../web/metronic/html.page.user.login.dropdown.php');
        // $pageHeader->addElement(':pageUserLoginDropDown', $userLogin);

        $bodyContent->addElement(':pageHeader', $pageHeader);

        $pageSideBar = new \Html\Element($bodyData);
        $pageSideBar->require('../web/metronic/html.page.sidebar.php');
        $bodyContent->addElement(':pageSidebar', $pageSideBar);

        // $pageHead = new \Html\Element($bodyData);
        // $pageHead->require('../web/metronic/html.page.head.php');
        // $bodyContent->addElement(':pageHead', $pageHead);

        $breadCrumb = new \Html\Element($bodyData);
        $breadCrumb->require('../web/metronic/html.page.breadcrumb.php');
        $bodyContent->addElement(':pageBreadCrumb', $breadCrumb);

        $scripts = new \Html\Element($bodyData);
        $scripts->require('../web/metronic/html.page.scripts.php');
        $bodyContent->addElement(':pageScripts', $scripts);

        // $quickSidebar = new \Html\Element($bodyData);
        // $quickSidebar->require('../web/metronic/html.page.quick.sidebar.php');
        // $bodyContent->addElement(':pageQuickSideBar', $quickSidebar);

        // $quickNav = new \Html\Element($bodyData);
        // $quickNav->require('../web/metronic/html.page.quick.nav.php');
        // $bodyContent->addElement(':pageQuickNav', $quickNav);

        $bodyContent->addElement($placeHolder, $content);

        $lay = new \Html\Composite();
        $lay->setHeadContent($htmlHead);
        $lay->addElement($bodyContent);
        return $lay;
    }
}