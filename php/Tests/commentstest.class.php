<?php 
/**
* 
*/

require_once '../classes/comment.class.php';
require_once '../db.class.php';
class CommentsTest extends PHPUnit_Framework_TestCase
{
	public function testAddd(){
		$comment = new Comment();
		$comment->name = 'James';
		$comment->email = 'jsingizi7@gmail.com';
		$comment->datePosted = time();
		$comment->projectId = 'eb4bcad68869f97ff0a91ff3f1e61f17';
		$comment->comment= 'his is a great project, keep on working';
		$comment->status = 0;

		$result = $comment->add();
		$this->assertEquals(true,$result);
	}
}

 ?>