<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Usuario Entity
 *
 * @property int $Id
 * @property string $nombre
 * @property string $apellido
 * @property string $Correo
 * @property string $Password
 * @property string $rol
 * @property \Cake\I18n\Time $creado
 * @property \Cake\I18n\Time $modificado
 */
class Usuario extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'Id' => false
    ];

    //ENCRIPTAR PASSWORD
    protected function _setPassword($Password)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($Password);
    }
}
