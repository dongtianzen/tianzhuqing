<?php
/**
 * \Drupal\Sniffs\CSS\ColourDefinitionSniff.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

namespace Drupal\Sniffs\CSS;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

/**
 * \Drupal\Sniffs\CSS\ColourDefinitionSniff.
 *
 * Ensure colours are defined in lower-case.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */
class ColourDefinitionSniff implements Sniff
{

    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = array('CSS');


    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return array(int)
     */
    public function register()
    {
        return array(T_COLOUR);

    }//end register()


    /**
     * Processes the tokens that this sniff is interested in.
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file where the token was found.
     * @param int                         $stackPtr  The position in the stack where
     *                                               the token was found.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $colour = $tokens[$stackPtr]['content'];

        $expected = strtolower($colour);
        if ($colour !== $expected) {
            $error = 'CSS colours must be defined in lowercase; expected %s but found %s';
            $data  = array(
                      $expected,
                      $colour,
                     );
            $fix   = $phpcsFile->addFixableError($error, $stackPtr, 'NotLower', $data);
            if ($fix === true) {
                $phpcsFile->fixer->replaceToken($stackPtr, $expected);
            }
        }

    }//end process()


}//end class
