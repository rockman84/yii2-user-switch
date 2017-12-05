# yii2-user-switch
package for quick easy login when do development
## Install Package
```
php composer.phar require sky\yii2-user-switch "*"
```
or add in composer.json
```
"sky/yii2-user-switch" : "*"
```
## How To Use
add at config file config/web.php or common/config/main.php
```php
[
  'modules' => [
    'userswicth' => [
      'class' => 'sky\userswitch\Module'
    ],
  ]
]
```
then go to http://sitename.com/userswitch or http://sitename.com?r=userswitch depend on your urlmanager settings

## Configuration
- gridColumns
- dataProvider
- ipAllow
- likeAttributes

### Example
```php
[
  'modules' => [
    'userswicth' => [
      'class' => 'sky\userswitch\Module',
      'gridColumns' => ['id', 'username', 'email'],
      'likeAttributes' => ['email'],
    ],
  ]
]
```
