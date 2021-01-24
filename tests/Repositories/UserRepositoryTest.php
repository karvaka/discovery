<?php

declare(strict_types=1);

namespace Tests\Repositories;

use PDO;
use Faker\Factory;
use Faker\Generator;
use App\Models\User;
use App\Repositories\UserRepository;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    private ?UserRepository $userRepository = null;
    private ?Generator $faker = null;

    public function setUp(): void
    {
        parent::setUp();

        if (is_null($this->userRepository)) {
            $this->userRepository = new UserRepository($this->app->get(PDO::class));
        }

        if (is_null($this->faker)) {
            $this->faker = Factory::create();
        }

        $this->userRepository->up();
    }

    public function tearDown(): void
    {
        parent::tearDown();

        $this->userRepository->down();

        $this->userRepository = null;
    }

    public function testGetTotalCountReturnsActualValue(): void
    {
        $this->assertEquals(0, $this->userRepository->getTotalCount());

        for ($i = 0; $i < 10; $i++) {
            $this->userRepository->insert($this->makeFakeUser());
        }

        $this->assertEquals(10, $this->userRepository->getTotalCount());
    }

    public function testFindReturnsUserIfRecordExists(): void
    {
        $this->userRepository->insert($fake = $this->makeFakeUser());

        $user = $this->userRepository->find($fake->id);

        $this->assertInstanceOf(User::class, $user);
    }

    public function testFindReturnsNullIfRecordDoesntExists(): void
    {
        $this->assertNull($this->userRepository->find(777));
    }

//    public function testFindThrowsExceptionIfRecordDoesntExists(): void
//    {
//    }

    public function testIsEmailExistsReturnsBoolean(): void
    {
        $email = 'billy@cobham.com';

        $this->assertFalse($this->userRepository->isEmailExists($email));

        $user = $this->makeFakeUser();
        $user->email = $email;
        $this->userRepository->insert($user);

        $this->assertTrue($this->userRepository->isEmailExists($email));
    }

    public function testInsertCreatesNewRecordAndSetsId(): void
    {
        $this->assertEquals(0, $this->userRepository->getTotalCount());

        $user = $this->makeFakeUser();

        $this->assertNull($user->id);

        $user = $this->userRepository->insert($user);

        $this->assertEquals(1, $this->userRepository->getTotalCount());

        $this->assertNotNull($user->id);
    }

    public function testUpdateChangesName(): void
    {
        $user = $this->userRepository->insert($this->makeFakeUser());

        $this->assertNotEquals($user->name, '');

        $user->name = 'Dmitry';

        $this->userRepository->update($user);

        $this->assertEquals($user->name, 'Dmitry');
    }

    public function testDeleteRemovesRecord(): void
    {
        $user = $this->userRepository->insert($this->makeFakeUser());

        $this->assertEquals(1, $this->userRepository->getTotalCount());

        $this->userRepository->delete($user);

        $this->assertEquals(0, $this->userRepository->getTotalCount());
    }

    protected function makeFakeUser(): User
    {
        $user = new User();
        $user->name = $this->faker->name;
        $user->email = $this->faker->safeEmail;
        $user->setPassword('password');

        return $user;
    }
}
