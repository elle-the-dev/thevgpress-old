<?php

class MessagingTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testAdd()
	{
        Messaging::add('apples', 'a');
        Messaging::add('oranges', 'x');
        Messaging::add('apples', 'b');
        Messaging::add('oranges', 'y');
        Messaging::add('apples', 'c');
        Messaging::add('oranges', 'z');

        $apples = Messaging::get('apples');
        $oranges = Messaging::get('oranges');

        $this->assertTrue($apples[0] == 'a' && $apples[1] == 'b' && $apples[2] == 'c'
            && $oranges[0] == 'x' && $oranges[1] == 'y' && $oranges[2] == 'z');
	}

}
