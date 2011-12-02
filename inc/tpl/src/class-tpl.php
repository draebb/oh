<?php
/**
 * This file is part of Tpl.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Tpl
 */


require_once dirname( __FILE__ ) . '/class-tpl-blocks.php';


/**
 * A template engine supports template inheritance.
 */
class Tpl {
	/**
	 * The block helper object.
	 *
	 * @var Tpl_Blocks
	 */
	public $blocks;
	protected $current;
	protected $parents;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->parents = array();
		$this->blocks = new Tpl_Blocks();
	}

	/**
	 * Renders a template.
	 *
	 * @param string $name The template name
	 *
	 * @return string The evaluated template
	 *
	 * @throws \InvalidArgumentException if the template does not exist
	 */
	public function render( $name ) {
		if ( ! file_exists( $name ) ) {
			throw new InvalidArgumentException(
				sprintf('The template "%s" does not exist.', $name )
			);
		}

		$this->current = $name;
		$this->parents[$name] = null;

		$content = $this->evaluate( $name );

		if ( $this->parents[$name] ) {
			$content = $this->render( $this->parents[$name] );
		}

		return $content;
	}

	/**
	 * Evaluates a template.
	 *
	 * @param string $template The template name
	 *
	 * @return string The evaluated template
	 */
	protected function evaluate( $template ) {
		$tpl = $this;
		ob_start();
		require $template;
		return ob_get_clean();
	}

	/**
	 * Decorates the current template with another one.
	 *
	 * @param string $template The decorator template name
	 */
	public function extend( $template ) {
		$this->parents[$this->current] = $template;
	}
}
