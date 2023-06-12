<?php

use App\Models\User;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Builder;

class SearchTest extends TestCase
{
    /** @test */
    public function test_it_can_apply_search_condition_with_string()
    {
        $string = 'John';

        $result = MockModel::search('name', $string);

        $bindings = $result->getBindings();
        $compiledQuery = $result->toSql();

        $expectedQuery = "select * from `mock_models` where match (`name`) against (? in natural language mode)";
        $expectedBindings = [$string];

        $this->assertEquals($expectedQuery, $compiledQuery);
        $this->assertEquals($expectedBindings, $bindings);
    }

    /** @test */
    public function test_it_returns_original_model_when_string_is_empty()
    {

        $result = MockModel::search('name', '');

        $bindings = $result->getBindings();
        $compiledQuery = $result->toSql();

        $expectedQuery = "select * from `mock_models`";
        $expectedBindings = [];

        $this->assertEquals($expectedQuery, $compiledQuery);
        $this->assertEquals($expectedBindings, $bindings);
    }
}

class MockModel extends Illuminate\Database\Eloquent\Model
{
    //lege modelklasse voor de test
}
