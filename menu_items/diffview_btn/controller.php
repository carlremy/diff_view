<?php
namespace Concrete\Package\DiffView\MenuItem\DiffviewBtn;
use Page;
use CollectionVersion;
use \Concrete\Core\Page\Collection\Version\VersionList;

class Controller extends \Concrete\Core\Application\UserInterface\Menu\Item\Controller
{
  /**
   * Return false if you don't want to display the button
   * @return bool
   */
  public function displayItem()
  {
    $c = Page::getCurrentPage();
    $vl = new VersionList($c);
    if($vl->getTotal() > 1) {
      return true;
    }
    return false;
  }
}