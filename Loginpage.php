<?php

$user_accounts_file = 'logins.txt';

#Creating Users in logins.txt

create_user($user_accounts_file, 'admin', 'secretpassword');
create_user($user_accounts_file, 'moderator', 'secretpassword');
create_user($user_accounts_file, 'user', 'secretpassword');




#Testing if login.txt works

if(true === check_user($user_accounts_file, 'admin', 'secretpassword'))
{
echo 'Authorised1      ';

	if(true === check_user($user_accounts_file, 'moderator', 'secretpassword'))
	{
	echo 'Authorised2    ';

		if(true === check_user($user_accounts_file, 'user', 'secretpassword'))
		{
        	echo 'Authorised3    ';
       		exit;
}}}

/**
 * @param string $user_accounts_file
 * @param string $username
 * @param string $password
 * @return boolean
 */
function create_user($user_accounts_file, $username, $password)
{
       
        return (bool)file_put_contents(
                $user_accounts_file,
                sprintf(
                        "%s|%s|%s\r\n",
                        sha1(uniqid()),
                        $username,
                        $password
                ),
                FILE_APPEND
        );
}

/**
 * @param string $user_accounts_file
 * @param string $username
 * @param string $password
 * @return boolean
 */


function check_user($user_accounts_file, $username, $password)
{

        foreach(file($user_accounts_file) as $entry)
        {
                list($entry_key, $entry_username, $entry_password) = array_map('trim', explode('|', $entry));
                if($entry_username === $username && $entry_password === $password)
                {
                        return true;
                }
        }
        return false;
}
?>

