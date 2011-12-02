<?php
/**
 * This file is part of Tpl.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Tpl
 */


/**
 * Manages template blocks.
 */
class Tpl_Blocks {
	protected $blocks = array();
	protected $open_blocks = array();
	protected $parent_placeholder = '<!-- SupersUPErsupeR -->';
	protected $block_to_define;

	/**
	 * Returns true if need to define the block.
	 *
	 * @param string $name The block name
	 *
	 * @returns boolean
	 */
	public function need( $name ) {
		if ( ! isset( $this->blocks[$name] ) ) {
			$this->block_to_define = $name;
			return true;
		}
		if ( strpos( $this->blocks[$name],
		             $this->parent_placeholder ) !== false
		) {
			$this->block_to_define = $name;
			return true;
		}
		return false;
	}

	/**
	 * Returns the placeholder.
	 *
	 * The placeholder will be replaced with the content of the parent block.
	 *
	 * @return string
	 */
	public function parent() {
		return $this->parent_placeholder;
	}

	/**
	 * Starts a new block.
	 *
	 * This method starts an output buffer that will be closed when the stop()
	 * method is called.
	 *
	 * @param string $name The block name
	 *
	 * @throws \BadFunctionCallException
	 *   if the $name parameter is missing without call need() first
	 * @throws \InvalidArgumentException
	 *   if a slot with the same name is already started
	 */
	public function start( $name='' ) {
		if ( ! $name && $this->block_to_define ) {
			$name = $this->block_to_define;
			$this->block_to_define = null;
		}
		if ( ! $name ) {
			throw new BadFunctionCallException( 'Block name is required.' );
		}
		if ( in_array( $name, $this->open_blocks ) ) {
			throw new InvalidArgumentException(
				sprintf( 'A block named "%s" is already started.', $name )
			);
		}

		$this->open_blocks[] = $name;

		ob_start();
	}

	/**
	 * Stops a block.
	 *
	 * @throws \LogicException if no block has been started
	 */
	public function stop() {
		if ( ! $this->open_blocks ) {
			throw new LogicException( 'No block started.' );
		}

		$name = array_pop( $this->open_blocks );

		if ( ! $this->need( $name ) ) {
			ob_end_clean();
			return;
		}
		$this->set( $name, ob_get_clean() );
	}

	/**
	 * Gets the block content.
	 *
	 * @param string $name The block name
	 * @param string|Closure $default The default block content
	 *
	 * @return string
	 */
	public function get( $name, $default = false ) {
		if ( $default instanceof Closure ) {
			ob_start();
			call_user_func( $default );
			$default = ob_get_clean();
		}
		if ( ! isset( $this->blocks[$name] ) ) {
			return $default;
		}
		return str_replace(
			$this->parent_placeholder, $default, $this->blocks[$name]
		);
		return isset( $this->blocks[$name] ) ? $this->blocks[$name] : $default;
	}

	/**
	 * Sets a block content.
	 *
	 * @param string $name The block name
	 * @param string|Closure $content The block content
	 */
	public function set( $name, $content ) {
		if ( ! $this->need( $name ) ) {
			return;
		}
		if ( $content instanceof Closure ) {
			ob_start();
			call_user_func( $content );
			$content = ob_get_clean();
		}
		if ( ! isset( $this->blocks[$name] ) ) {
			$this->blocks[$name] = $content;
			return;
		}
		$this->blocks[$name] = str_replace(
			$this->parent_placeholder, $content, $this->blocks[$name]
		);
	}

	/**
	 * Returns true if the block exists.
	 *
	 * @param string $name The block name
	 *
	 * @return boolean
	 */
	public function has( $name ) {
		return isset( $this->blocks[$name] );
	}
}
