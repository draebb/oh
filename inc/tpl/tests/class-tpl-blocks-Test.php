<?php
require_once TPL_DIR . '/class-tpl-blocks.php';


class Tpl_Blocks_Test extends PHPUnit_Framework_TestCase {

	public $blocks;

	public function setUp() {
		$this->blocks = new Tpl_Blocks();
		ob_start();
	}

	public function tearDown() {
		ob_end_clean();
	}

	public function test_need_returns_true_if_block_not_defined() {
		$this->assertTrue( $this->blocks->need( 'name' ) );
	}

	public function test_need_returns_true_if_block_defined_but_calls_parent() {
		$this->blocks->set( 'name', $this->blocks->parent() . 'more' );
		$this->assertTrue( $this->blocks->need( 'name' ) );
	}

	public function test_need_returns_false_if_block_defind_and_not_calls_parent() {
		$this->blocks->set( 'name', 'content' );
		$this->assertFalse( $this->blocks->need( 'name' ) );
	}

	public function test_start_stop_define_a_block_of_content() {
		$this->blocks->start( 'name' );
			echo 'content';
		$this->blocks->stop();
		$this->assertEquals( 'content', $this->blocks->get( 'name' ) );
	}

	public function test_start_without_name_throws_BadFunctionCallException() {
		$this->setExpectedException('BadFunctionCallException');
		$this->blocks->start();
			echo 'content';
		$this->blocks->stop();
	}

	public function test_if_need_then_can_start_without_name() {
		if ( $this->blocks->need( 'name' ) ) {
			$this->blocks->start();
				echo 'content';
			$this->blocks->stop();
		}
		$this->assertEquals( 'content', $this->blocks->get( 'name' ) );
	}

	public function test_start_already_started_block_throws_an_InvalidArgumentException() {
		$this->setExpectedException('InvalidArgumentException');
		$this->blocks->start( 'name' );
		$this->blocks->start( 'name' );
	}

	public function test_stop_if_no_blocks_started_throws_a_LogicException() {
		$this->setExpectedException('LogicException');
		$this->blocks->stop();
	}

	public function test_nested_start_stop() {
		$this->blocks->start( '1' );
			echo '1';
			$this->blocks->start( '2' );
				echo '2';
			$this->blocks->stop();
		$this->blocks->stop();
		$this->assertEquals( '1', $this->blocks->get( '1' ) );
		$this->assertEquals( '2', $this->blocks->get( '2' ) );
	}

	public function test_set_and_get() {
		$this->blocks->set( 'name', 'content' );
		$result = $this->blocks->get( 'name' );
		$this->assertEquals( 'content', $result );
	}

	public function test_set_by_a_closure() {
		$that = $this;
		$this->blocks->set( 'name', function() use ( $that ) {
			echo $that->blocks->parent();
			echo 'child';
		} );
		$this->blocks->set( 'name', function() {
			echo 'parent';
		} );
		$result = $this->blocks->get( 'name' );
		$this->assertEquals( 'parentchild', $result );
	}

	public function test_get_default() {
		$result = $this->blocks->get( 'not_existing_name', 'default' );
		$this->assertEquals( 'default', $result );
	}

	public function test_get_with_a_closure_as_default_content() {
		$result = $this->blocks->get( 'not_existing_name', function() {
			echo 'default';
		} );
		$this->assertEquals( 'default', $result );
	}

	public function test_get_returns_false_if_not_defined() {
		$result = $this->blocks->get( 'not_existing_name' );
		$this->assertFalse( $result );
	}

	public function test_start_stop_do_not_saves_a_block_if_defined_and_no_parent_call() {
		$this->blocks->start( 'name' );
			echo 'child';
		$this->blocks->stop();
		$this->blocks->start( 'name' );
			echo 'parent';
		$this->blocks->stop();
		$result = $this->blocks->get( 'name' );
		$this->assertEquals( 'child', $result );
	}

	public function test_set_not_to_save_a_block_if_defined_and_no_parent_call() {
		$this->blocks->set( 'name', 'child' );
		$this->blocks->set( 'name', 'parent' );
		$result = $this->blocks->get( 'name' );
		$this->assertEquals( 'child', $result );
	}

	public function test_start_stop_parent_filled_with_the_parent_block_content() {
		$this->blocks->start( 'name' );
			echo $this->blocks->parent();
			echo 'child';
		$this->blocks->stop();
		$this->blocks->start( 'name' );
			echo 'parent';
		$this->blocks->stop();
		$result = $this->blocks->get( 'name' );
		$this->assertEquals( 'parentchild', $result );
	}

	public function test_set_parent_filled_with_the_parent_block_content() {
		$this->blocks->set( 'name', $this->blocks->parent() . 'child' );
		$this->blocks->set( 'name', 'parent' );
		$result = $this->blocks->get( 'name' );
		$this->assertEquals( 'parentchild', $result );
	}

	public function test_parent_filled_with_the_default_parent_block_content() {
		$this->blocks->set( 'name', $this->blocks->parent() . 'child' );
		$result = $this->blocks->get( 'name', 'parent' );
		$this->assertEquals( 'parentchild', $result );
	}

	public function test_parent_filled_with_the_default_parent_block_content_closure() {
		$this->blocks->set( 'name', $this->blocks->parent() . 'child' );
		$result = $this->blocks->get( 'name', function() {
			echo 'parent';
		} );
		$result = $this->blocks->get( 'name', 'parent' );
		$this->assertEquals( 'parentchild', $result );
	}

	public function test_has_returns_true_if_the_block_exists() {
		$this->blocks->set( 'name', 'content' );
		$result = $this->blocks->has( 'name' );
		$this->assertTrue( $result );
		$result = $this->blocks->has( 'not_existing' );
		$this->assertFalse( $result );
	}
}
