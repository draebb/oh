<?php
/**
 * This file is part of Tpl.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Tpl
 */


require_once dirname( __FILE__ ) . '/class-tpl.php';


/**
 * Customization for WordPress.
 */
class Tpl_WP extends Tpl {
	/**
	 * @param string $template
	 *   The decorator template name, which will pass to locate_template()
	 */
	public function extend( $template ) {
		$this->parents[$this->current] = locate_template( $template );
	}
}
