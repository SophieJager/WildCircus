<?php

namespace App\DataFixtures;

use App\Entity\AboutUs;
use App\Entity\Performances;
use App\Entity\Prices;
use App\Entity\PricesGroup;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {

        $performances = [
            0 => [
                'title' => 'Laugh',
                'description' => '<p>As an adult, come and discover our<strong> irresistible</strong> clowns, 
                                    between practical jokes and pranks let yourself be carried away by their 
                                    joy and fall back into childhood.</p>'
            ],
            1 => [
                'title' => 'Dream',
                'description' => 'Let yourself be carried away in a world where the real and the imaginary are one, in the company of our talented magicians, discover a wonderful world limited only by your imagination.'
            ],
            2 => [
                'title' => 'Marvel at',
                'description' => 'Tame the untameable in the company of our tamers, between roar and razor-sharp claws, watch these fierce felines turn into sweet kittens.'
            ]
        ];

        $aboutUses = [
            0 => [
                'title' => 'About us 1',
                'description' => '<p>The Wild Circus Family has been in entertainment and circus for 10 generations ! Yes, we are a big family and our circus is the cheapiest in the world... and why ? Is it because quality isn&#39;t the same ? No ! Is it because we care about our public ? Yes ! We consider that everybody has to be able to be amazed by so much skill, beauty, fun and tricks never seen before.... paying the right price !</p>'
            ]
        ];

        $pricesGroup = [
            0 => [
                'name'=>'Adults',
            ],
            1 => [
                'name'=>'Children under 12',
            ],
            2 => [
                'name'=>'Groups of 10 or more',
            ],
            3 => [
                'name'=>'School Groups',
            ]
        ];

        $prices = [
            0 => [
                'price_week' => 15,
                'price_week_end' => 20
            ],
            1 => [
                'price_week' => 7,
                'price_week_end' => 10
            ],
            2 => [
                'price_week' => 12,
                'price_week_end' => 17
            ],
            3 => [
                'price_week' => 5,
                'price_week_end' => 7
            ]
        ];


        foreach ($performances as $k => $value) {
            $performance = new Performances();
            $performance->setDescription($value['description']);
            $performance->setTitle($value['title']);
            $performance->setActive(1);
            $manager->persist($performance);
            $manager->flush();
        }

        foreach ($aboutUses as $k => $value) {
            $about = new AboutUs();
            $about->setDescription($value['description']);
            $about->setTitle($value['title']);
            $about->setActive(1);
            $manager->persist($about);
            $manager->flush();
        }

        foreach ($pricesGroup as $k => $value) {
            $num = 0;
            $priceGroup = new PricesGroup();
            $priceGroup->setName($value['name']);
            $priceGroup->setActive(1);
            $manager->persist($priceGroup);
            $manager->flush();

            $price = new Prices();
            $price->setGroups($priceGroup);
            $price->setPriceWeek($prices[$num]['price_week']);
            $price->setPriceWeekEnd($prices[$num]['price_week_end']);
            $manager->persist($price);
            $manager->flush();
        }

        $user = new User();
        $user->setEmail('admin@admin.com');
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                'admin'
            )
        );
        $user->setRoles(['ROLE_ADMIN']);

        $manager->persist($user);
        $manager->flush();
    }
}
