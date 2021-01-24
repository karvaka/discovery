<?php declare(strict_types=1);

namespace App\Repositories;

use PDO;
use DateTime;
use LogicException;
use App\Models\User;

class UserRepository
{
    public function __construct(private PDO $connection)
    {
    }

    public function findAll(): iterable
    {
        $stmt = $this->connection->prepare('
            SELECT * FROM users
        ');
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
        return $stmt->fetchAll();
    }

    public function getTotalCount(): int
    {
        return (int)$this->connection->query('
            SELECT COUNT(*) FROM users
        ')->fetchColumn();
    }

    public function find(int $id): ?User
    {
        $stmt = $this->connection->prepare('
            SELECT * FROM users WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
        $user = $stmt->fetch();

        return $user === false ? null : $user;
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = $this->connection->prepare('
            SELECT * FROM users WHERE email = :email
        ');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
        $user = $stmt->fetch();

        return $user === false ? null : $user;
    }

    public function isEmailExists(string $email): bool
    {
        return $this->findByEmail($email) instanceof User;
    }

    public function save(User $user): User
    {
        if (is_null($user->id)) {
            return $this->insert($user);
        }

        return $this->update($user);
    }

    public function insert(User $user): User
    {
        $stmt = $this->connection->prepare('
            INSERT INTO users 
                (name, email, password, remember_token, created_at) 
            VALUES 
                (:name, :email , :password, :remember_token, :created_at)
        ');
        $stmt->bindParam(':name', $user->name);
        $stmt->bindParam(':email', $user->email);
        $stmt->bindParam(':password', $user->password);
        $stmt->bindParam(':remember_token', $user->remember_token);
        $stmt->bindValue(':created_at', $user->created_at = (new DateTime())->format('Y-m-d H:i:s'));
        if ($stmt->execute()) {
            $user->id = (int)$this->connection->lastInsertId();
        }
        return $user;
    }

    public function update(User $user): User
    {
        if (is_null($user->id)) {
            throw new LogicException(
                'Cannot update user that does not yet exist in the database.'
            );
        }

        $stmt = $this->connection->prepare('
            UPDATE users
            SET name = :name,
                email = :email,
                password = :password,
                remember_token = :remember_token,
                updated_at = :updated_at
            WHERE id = :id
        ');
        $stmt->bindParam(':name', $user->name);
        $stmt->bindParam(':email', $user->email);
        $stmt->bindParam(':password', $user->password);
        $stmt->bindParam(':remember_token', $user->remember_token);
        $stmt->bindValue(':updated_at', $user->updated_at = (new DateTime())->format('Y-m-d H:i:s'));
        $stmt->bindParam(':id', $user->id, PDO::PARAM_INT);
        $stmt->execute();

        return $user;
    }

    public function delete(User $user): void
    {
        $stmt = $this->connection->prepare('
            DELETE FROM users WHERE id = :id
        ');
        $stmt->bindParam(':id', $user->id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function up(): bool
    {
        return false !== $this->connection->exec('
            CREATE TABLE IF NOT EXISTS `users` (
                id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                remember_token VARCHAR(100),
                created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP
            )
        ');
    }

    public function down(): bool
    {
        return false !== $this->connection->exec('
            DROP TABLE users
        ');
    }
}
