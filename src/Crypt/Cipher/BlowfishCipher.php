<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Crypt\Cipher;

/**
 * The BlowfishChipher class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class BlowfishCipher extends McryptCipher
{
	/**
	 * @var    integer  The mcrypt cipher constant.
	 * @see    http://www.php.net/manual/en/mcrypt.ciphers.php
	 * @since  {DEPLOY_VERSION}
	 */
	protected $type = MCRYPT_BLOWFISH;

	/**
	 * @var    integer  The mcrypt block cipher mode.
	 * @see    http://www.php.net/manual/en/mcrypt.constants.php
	 * @since  {DEPLOY_VERSION}
	 */
	protected $mode = MCRYPT_MODE_CBC;
}
 