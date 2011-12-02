<?php
require_once TPL_DIR . '/class-tpl.php';


class Tpl_Test extends PHPUnit_Framework_TestCase {

	protected $tpl;
	protected $temp_dir;

	public function setUp() {
		$this->tpl = new Tpl();
		$this->temp_dir = dirname( __FILE__ ) . '/.temp';
		rrmdir( $this->temp_dir );
		mkdir( $this->temp_dir );
		chdir( $this->temp_dir );
	}

	public function tearDown() {
		rrmdir( $this->temp_dir );
	}

	public function test_render() {
		write_file( 'test.php', 'hello');
		$result = $this->tpl->render( './test.php' );
		$this->assertEquals( 'hello', $result );
	}

	public function test_block_property_is_ready() {
		write_file( 'test.php', '<?php echo $tpl->blocks instanceof Tpl_Blocks; ?>' );
		$result = $this->tpl->render( './test.php' );
		$this->assertEquals( '1', $result );
	}

	public function test_tpl_variable_injected_in_templates() {
		write_file( 'test.php', '<?php echo $tpl instanceof Tpl; ?>' );
		$result = $this->tpl->render( './test.php' );
		$this->assertEquals( '1', $result );
	}

	public function test_only_content_of_base_template_is_rendered() {
		write_file( 'base.php', 'base' );
		write_file( 'child.php', '<?php $tpl->extend( "./base.php" ) ?>child');
		$result = $this->tpl->render( './child.php' );
		$this->assertEquals( 'base', $result );
	}

	public function test_render_not_existing_file_throws_an_InvalidArgumentException() {
		$this->setExpectedException( 'InvalidArgumentException');
		$result = $this->tpl->render( './404.php' );
	}
}
