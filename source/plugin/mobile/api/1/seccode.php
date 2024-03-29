<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: seccode.php 27959 2012-02-17 09:52:22Z monkey $
 */

if(!defined('IN_MOBILE_API')) {
	exit('Access Denied');
}

include_once 'misc.php';

class mobile_api {

	function common() {
		global $_G;

		require_once libfile('function/seccode');
		$seccode = make_seccode($_GET['sechash']);

		if(!$_G['setting']['nocacheheaders']) {
			@header("Expires: -1");
			@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
			@header("Pragma: no-cache");
		}

		require_once libfile('class/seccode');

		$type = in_array($_G['setting']['seccodedata']['type'], array(2, 3)) ? 0 : $_G['setting']['seccodedata']['type'];

		$code = new seccode();
		$code->code = $seccode;
		$code->type = $type;
		$code->width = isset($_GET['width']) && $_GET['width'] >= 100 && $_GET['width'] <= 600 ? $_GET['width'] : $_G['setting']['seccodedata']['width'];
		$code->height = isset($_GET['height']) && $_GET['height'] >= 30 && $_GET['height'] <= 240 ? $_GET['height'] :$_G['setting']['seccodedata']['height'];
		$code->background = $_G['setting']['seccodedata']['background'];
		$code->adulterate = $_G['setting']['seccodedata']['adulterate'];
		$code->ttf = $_G['setting']['seccodedata']['ttf'];
		$code->angle = $_G['setting']['seccodedata']['angle'];
		$code->warping = $_G['setting']['seccodedata']['warping'];
		$code->scatter = $_G['setting']['seccodedata']['scatter'];
		$code->color = $_G['setting']['seccodedata']['color'];
		$code->size = $_G['setting']['seccodedata']['size'];
		$code->shadow = $_G['setting']['seccodedata']['shadow'];
		$code->animator = 0;
		$code->fontpath = DISCUZ_ROOT.'./static/image/seccode/font/';
		$code->datapath = DISCUZ_ROOT.'./static/image/seccode/';
		$code->includepath = DISCUZ_ROOT.'./source/class/';

		$code->display();

	}

	function output() {}

}

?>