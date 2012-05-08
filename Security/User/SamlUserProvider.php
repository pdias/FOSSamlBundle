<?php
/**
 * Description of SamlUserProvider
 *
 * @author Paulo Dias
 */
namespace ipcb\FOSSamlBundle\Security\User;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class SamlUserProvider implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        $auth = new \SimpleSAML_Auth_Simple('default-sp'); 
        $auth->requireAuth(); 
        
        if ($auth->isAuthenticated()) {
            $attributes = $auth->getAttributes();
            
            $roles[] = 'ROLE_'.mb_strtoupper($attributes['eduPersonPrimaryAffiliation'][0]);
            $roles[] = 'ROLE_USER';

            $user = new SamlUser($username, $roles);
            
            foreach($attributes as $key => $attribute){
                if(count($attribute)==1) {
                    $user->setAttribute($key, $attribute[0]);
                }else{
                    $user->setAttribute($key, $attribute);
                }
            }
            
            return $user;
        } else {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
        }
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof SamlUser) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'ipcb\FOSSamlBundle\Security\User\SamlUser';
    }
}
