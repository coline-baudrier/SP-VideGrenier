<?php
use PHPUnit\Framework\TestCase;
use App\Models\Articles;
use App\Models\User;
use App\Models\Cities;

class ListTest extends TestCase
{
    public function testAllArticles()
    {
        //Vérifier que le nombre d'enregistrement d'articles est bien supérieur à un
        $filter = "data";
        $result = Articles::getAll($filter);

        $this->assertGreaterThan(1, count($result));
        $keys = array_keys($result[0]);
        $this->assertSame(["id", "name", "description", "published_date", "user_id", "views", "picture"], $keys);
    }

    public function testOneArticle() {
        // Vérifie qu'on obtient bien le premier article enregistré
        $result = Articles::getOne(1);
        $this->assertSame(1, count([$result]));

        $keys = array_keys($result[0]);
        $this->assertSame(
            [
                "id", "name", "description", "published_date",
                "user_id", "views", "picture", "username",
                "email", "password", "salt", "is_admin"
            ],
            $keys
        );
    }

    public function testGetByLogin()
    {
        $login = "coline.baudrier@outlook.com";
        $result = User::getByLogin($login);
        $keys = array_keys($result);
        $this-> assertSame(["id", "username", "email", "password", "salt", "is_admin"], $keys);
    }

    public function testSearchCity() {
        $result = Cities::search('morlaix');
        fwrite(STDOUT, print_r($result, TRUE));
        $this->assertGreaterThan(0, count($result));
    }

}