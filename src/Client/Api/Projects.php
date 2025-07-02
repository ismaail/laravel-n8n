<?php

namespace KayedSpace\N8n\Client\Api;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use KayedSpace\N8n\Enums\RequestMethod;

class Projects extends AbstractApi
{
    /**
     * @throws ConnectionException
     * @throws RequestException
     */
    public function create(array $payload): array
    {
        return $this->request(RequestMethod::Post, '/projects', $payload);
    }

    /**
     * @throws ConnectionException
     * @throws RequestException
     */
    public function list(int $limit = 100, ?string $cursor = null): array
    {
        return $this->request(RequestMethod::Get, '/projects', array_filter([
            'limit' => $limit,
            'cursor' => $cursor,
        ]));
    }

    /**
     * @throws ConnectionException
     * @throws RequestException
     */
    public function update(string $projectId, array $payload): void
    {
        $this->request(RequestMethod::Put, "/projects/{$projectId}", $payload); // 204
    }

    /**
     * @throws ConnectionException
     * @throws RequestException
     */
    public function delete(string $projectId): void
    {
        $this->request(RequestMethod::Delete, "/projects/{$projectId}"); // 204
    }

    /**
     * @throws ConnectionException
     * @throws RequestException
     */
    public function addUsers(string $projectId, array $relations): void
    {
        $this->request(RequestMethod::Post, "/projects/{$projectId}/users", ['relations' => $relations]);
    }

    /**
     * @throws ConnectionException
     * @throws RequestException
     */
    public function changeUserRole(string $projectId, string $userId, string $role): void
    {
        $this->request(RequestMethod::Patch, "/projects/{$projectId}/users/{$userId}", ['role' => $role]);
    }

    /**
     * @throws ConnectionException
     * @throws RequestException
     */
    public function removeUser(string $projectId, string $userId): void
    {
        $this->request(RequestMethod::Delete, "/projects/{$projectId}/users/{$userId}");
    }
}
