<?php
/**
 * Description of SamlUserToken
 *
 * @author Paulo Dias
 */
namespace ipcb\FOSSamlBundle\Security\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class SamlUserToken extends AbstractToken
{
    public function getCredentials()
    {
        return '';
    }
}