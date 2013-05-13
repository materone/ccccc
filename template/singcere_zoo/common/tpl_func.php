                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <?php 

/**
 *      (C)2007-2013 singcere.net
 *      This is a freeware, But you have no right to modify or distribute
 *       
 */

// 获取L2 边栏
function sc_zoo_portal_sidebarnav() {
	global $_G;	
	$snav = array();
	foreach($_G['cache']['portalcategory'] as $nav) {
		if($nav['level'] == 0) {
			$snav[$nav['catid']]['cat'] = $nav;	
		} else if($nav['level'] == 1) {
			$snav[$nav['topid']]['sub'][$nav['catid']] = $nav;
		}
	}
	return $snav;
}

// 获取当前及子集分类评论
function sc_zoo_portal_newest_replies($catid, $count = 10) {
	global $_G;
	$subids = array($catid);
	foreach($_G['cache']['portalcategory'][$catid]['children'] as $childid) {
		$subids[] = $childid;
		is_array($_G['cache']['portalcategory'][$childid]['children']) && $subids = array_merge($subids, $_G['cache']['portalcategory'][$childid]['children']);
	}
	
	$replies = DB::fetch_all("SELECT comment.*, article.title, article.htmlmade, article.htmlname, article.htmldir, article.aid FROM %t comment LEFT JOIN %t article ON comment.id = article.aid WHERE comment.cid IN(%n) AND comment.idtype=%s AND comment.status = 0 ORDER BY comment.dateline DESC LIMIT %d", array('portal_comment', 'portal_article_title', $subids, 'aid', $count));
	return $replies;
}






?>