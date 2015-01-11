<p>
    Database connection is not correctly set up.
    Now open up application/config/database.php script,
    and look up these keys:
</p>
<style>
    .aqsara_code{
        font-family: monospace;
    }
</style>
<div class="aqsara_code">
    <ul>
        <li>
            $db['default']['hostname'] = 'hostname';
        </li>
        <li>
            $db['default']['username'] = 'username';
        </li>
        <li>
            $db['default']['password'] = 'password';
        </li>
        <li>
            $db['default']['database'] = 'database';
        </li>
    </ul>
</div>
<p>
    Try to fix the database configuration based on your database server settings.
</p>
