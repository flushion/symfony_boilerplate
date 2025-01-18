<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

final class TaskVoter extends Voter
{
    public const EDIT = 'POST_EDIT';
    public const VIEW = 'POST_VIEW';
    public const DELETE = 'POST_DELETE';

    protected function supports(string $attribute, mixed $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::EDIT, self::VIEW])
            && $subject instanceof \App\Entity\Task;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::EDIT:
                // logic to determine if the user can EDIT
                // return true or false
                $this->canEdit($subject, $user);
                break;

            case self::VIEW:
                // logic to determine if the user can VIEW
                // return true or false
                $this->canView($subject, $user);
                break;
            
            case self::DELETE:
                // logic to determine if the user can DELETE
                // return true or false
                $this->canDelete($subject, $user);
                break;
        }

        return false;
    }

    public function canView(\App\Entity\Task $task, UserInterface $user): bool
    {
        // this assumes that the Task object has a `getAuthor()` method
        return $user === $task->getAuthor() || in_array('ROLE_ADMIN', $user->getRoles());
    }

    public function canEdit(\App\Entity\Task $task, UserInterface $user): bool
    {
        // this assumes that the Task object has a `getAuthor()` method
        return $user === $task->getAuthor() || in_array('ROLE_ADMIN', $user->getRoles());
    }

    public function canDelete(\App\Entity\Task $task, UserInterface $user): bool
    {
        // this assumes that the Task object has a `getAuthor()` method
        return $user === $task->getAuthor() || in_array('ROLE_ADMIN', $user->getRoles());
    }
}
