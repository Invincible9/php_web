<?php

class Family {

    /**
     * @var Person[]
     */
    private $peoples;

    public function addMember(Person $member){
        $this->peoples[] = $member;
    }

    public function getOldestMember(){
        $members = $this->peoples;

        usort($members, function (Person $p1, Person $p2) {
            return $p2->getAge() <=> $p1->getAge();
        });

        return $members[0];
    }
}