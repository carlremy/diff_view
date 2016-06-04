<?php
namespace Concrete\Package\DiffView;

defined('C5_EXECUTE') or die(_("Access Denied."));
use Environment;
use Core;
use AssetList;
use Asset;
use Concrete\Core\Support\Facade\Events;

class Controller extends \Concrete\Core\Package\Package {

  protected $pkgHandle = 'diff_view';
  protected $appVersionRequired = '5.7.5.8';
  protected $pkgVersion = '0.0.1';

  public function getPackageDescription() {
    return t("View differences between page versions.");
  }

  public function getPackageName() {
    return t("Diff View");
  }

  public function install() {
    $pkg = parent::install();

  }

  public function on_start()
  {
      $req = \Request::getInstance();
      //override core by package ...

      if( $req->getPathInfo() == '/tools/required/pages/preview_version') {
        //header('Content-type:text/plain');
        //var_dump( get_class_methods($req) );
        //exit;

      }

      // Make sure we don't inject our code if it's called by an AJAX request
      /*
      if (!$req->isXmlHttpRequest()) {
          // @var $menuHelper \Concrete\Core\Application\Service\UserInterface\Menu
        $menuHelper = Core::make('helper/concrete/ui/menu');

        $menuHelper->addPageHeaderMenuItem('diffview_btn', $this->pkgHandle, array(
          'icon' => 'columns',
          'label' => t('View Diffs'),
          'position' => 'left',
          'href' => '#',
          'linkAttributes' => array('id' => 'diffview-button', 'target' => '_blank', 'title' => t('View Differences'), 'onclick' => 'return false;')
        ));
      }
      */

      $al = AssetList::getInstance();
      $al->register( 'javascript', 'htmldiff', 'js/htmldiff.js', array('minify' => true, 'position' => Asset::ASSET_POSITION_FOOTER, 'combine' => true), $this );
      $al->register( 'javascript', 'diff_view', 'js/diff_view.js', array('minify' => true, 'position' => Asset::ASSET_POSITION_FOOTER, 'combine' => true), $this );

      $al->register( 'css', 'diff_view', 'css/diff_view.css', array('minify' => true, 'position' => Asset::ASSET_POSITION_HEADER, 'combine' => true), $this );

      $envObj = Environment::get();
      $envObj->overrideCoreByPackage('views/panels/details/page/versions.php', $this);

      Events::addListener('on_page_view', function($event) {
        $u = new \User();
        //if($u->isLoggedIn()) {
          $c = $event->getPageObject();
          //$c = \Page::getCurrentPage();
          //if($c->isEditMode()) {
          $ctl = $c->getPageController();
          $ctl->requireAsset('javascript', 'htmldiff');
          $ctl->requireAsset('javascript', 'diff_view');
          $ctl->requireAsset('css', 'diff_view');
          //}
        //}
      });
  }

}
