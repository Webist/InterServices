<?php


namespace View;


class Model
{
    /**
     * Content array map
     * @var \Dom\Html\Element
     */
    private $contentArrayMap;

    /**
     * Meta array map, other than content data, such as title, keywords
     * @var array
     */
    private $metaArrayMap;

    public function __construct(\Dom\Html\Element $contentArrayMap, array $metaArrayMap)
    {
        $this->contentArrayMap = $contentArrayMap;
        $this->metaArrayMap = $metaArrayMap;
    }

    /**
     * @param bool $withBaseContent current template will be wrapped with baseContent
     * @return mixed|string
     */
    public function render($withBaseContent = true)
    {
        if($withBaseContent) {
            $content = $this->buildContentWith(':pageBaseContent', $this->contentArrayMap);
            return $content->render();
        }

        return $this->contentArrayMap->render();
    }


    /**
     * Generic html body content builder to reuse together with a specific body content
     *
     * @param string $placeHolder
     * @param \Dom\Html\Element $content
     * @return \Dom\Html\Composite
     */
    private function buildContentWith(string $placeHolder, \Dom\Html\Element $content)
    {
        $headData = new \Dom\Html\HeadData();
        $headData->setTitle($this->metaArrayMap['head']['title']);

        $htmlHead = new \Dom\Html\Element($headData);
        $htmlHead->require(dirname(dirname(__DIR__)) . '/web/metronic/html.head.php');

        $bodyData = new \Dom\Html\BodyData();
        $bodyData->setTitle($this->metaArrayMap['body']['title']);

        $bodyContent = new \Dom\Html\Element($bodyData);
        $bodyContent->require(dirname(dirname(__DIR__)) . '/web/metronic/html.page.php');

        $pageHeader = new \Dom\Html\Element($bodyData);
        $pageHeader->require(dirname(dirname(__DIR__)) . '/web/metronic/html.page.header.php');

        /* ---- DO NOT REMOVE THE temp DISABLED CONTENT BELOW ---- */
        // subcontent
        // $pageActions = new \Dom\Html\Element($bodyData);
        // $pageActions->require(dirname(dirname(__DIR__)) . '/web/metronic/html.page.actions.php');
        // $pageHeader->addElement(':pageActions', $pageActions);

        // $searchBox = new \Dom\Html\Element($bodyData);
        // $searchBox->require(dirname(dirname(__DIR__)) . '/web/metronic/html.page.searchbox.php');
        // $pageHeader->addElement('pageSearchBox', $searchBox);

        // $notificationDropDown = new \Dom\Html\Element($bodyData);
        // $notificationDropDown->require(dirname(dirname(__DIR__)) . '/web/metronic/html.page.notification.dropdown.php');
        // $pageHeader->addElement(':pageNotificationDropdown', $notificationDropDown);

        // $inboxDropDown = new \Dom\Html\Element($bodyData);
        // $inboxDropDown->require(dirname(dirname(__DIR__)) . '/web/metronic/html.page.inbox.dropdown.php');
        // $pageHeader->addElement(':pageInboxDropDown', $inboxDropDown);

        // $tasksDropDown = new \Dom\Html\Element($bodyData);
        // $tasksDropDown->require(dirname(dirname(__DIR__)) . '/web/metronic/html.page.tasks.dropdown.php');
        // $pageHeader->addElement(':pageTasksDropDown', $tasksDropDown);

        // $userLogin = new \Dom\Html\Element($bodyData);
        // $userLogin->require(dirname(dirname(__DIR__)) . '/web/metronic/html.page.user.login.dropdown.php');
        // $pageHeader->addElement(':pageUserLoginDropDown', $userLogin);

        $bodyContent->addElement(':pageHeader', $pageHeader);

        $pageSideBar = new \Dom\Html\Element($bodyData);
        $pageSideBar->require(dirname(dirname(__DIR__)) . '/web/metronic/html.page.sidebar.php');
        $bodyContent->addElement(':pageSidebar', $pageSideBar);

        // $pageHead = new \Dom\Html\Element($bodyData);
        // $pageHead->require(dirname(dirname(__DIR__)) . '/web/metronic/html.page.head.php');
        // $bodyContent->addElement(':pageHead', $pageHead);

        $breadCrumb = new \Dom\Html\Element($bodyData);
        $breadCrumb->require(dirname(dirname(__DIR__)) . '/web/metronic/html.page.breadcrumb.php');
        $bodyContent->addElement(':pageBreadCrumb', $breadCrumb);

        $scripts = new \Dom\Html\Element($bodyData);
        $scripts->require(dirname(dirname(__DIR__)) . '/web/metronic/html.page.scripts.php');
        $bodyContent->addElement(':pageScripts', $scripts);

        // $quickSidebar = new \Dom\Html\Element($bodyData);
        // $quickSidebar->require(dirname(dirname(__DIR__)) . '/web/metronic/html.page.quick.sidebar.php');
        // $bodyContent->addElement(':pageQuickSideBar', $quickSidebar);

        // $quickNav = new \Dom\Html\Element($bodyData);
        // $quickNav->require(dirname(dirname(__DIR__)) . '/web/metronic/html.page.quick.nav.php');
        // $bodyContent->addElement(':pageQuickNav', $quickNav);

        $bodyContent->addElement($placeHolder, $content);

        $lay = new \Dom\Html\Composite();
        $lay->setHeadContent($htmlHead);
        $lay->addElement($bodyContent);
        return $lay;
    }
}