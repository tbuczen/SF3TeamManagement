<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Country;
use AppBundle\Entity\Team;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Player;
use Gedmo\Sluggable\Util as Sluggable;

class LoadDummyDataFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * @var array Associative array containing whole necessary data set for application to work
     */
    private $data = [
        //Belgium
        "BE" => [
        "name" => "Belgium",
        "teams" => [
            [
                "name" => "KV Mechelen",
                "players" => [
                    ["name" => "Colin","surname" => "Coosemans", "age" => "03-08-1992", "position" => Player::POSITION_GOALKEEPER ],
                    ["name" => "Dimitrios", "surname" => "Kolovos","age" => "27-04-1993","position" => Player::POSITION_ATTACKING],
                    ["name" => "Zeljko","surname" => "Filipovic","age" => "03-10-1988","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Glenn","surname" => "Claes","age" => "08-03-1994","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Aleksandar","surname" => "Bjelica","age" => "07-01-1994","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
            [
                "name" => "RSC Anderlecht",
                "players" => [
                    ["name" => "Frank","surname" => "Boeckx","age" => "27-09-1986","position" => Player::POSITION_GOALKEEPER],
                    ["name" => "Łukasz","surname" => "Teodorczyk","age" => "03-06-1991","position" => Player::POSITION_ATTACKING],
                    ["name" => "Youri","surname" => "Tielemans","age" => "07-05-1997","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Andy","surname" => "Najar","age" => "16-03-1993","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Bram","surname" => "Nuytinck","age" => "04-05-1990","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
            [
                "name" => "Royal Charleroi",
                "players" => [
                    ["name" => "Nicolas","surname" => "Penneteau","age" =>"20-02-1981","position" => Player::POSITION_GOALKEEPER],
                    ["name" => "David","surname" => "Pollet","age" => "12-08-1988","position" => Player::POSITION_ATTACKING],
                    ["name" => "Clément","surname" => "Tainmont","age" => "13-02-1986","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Cristian","surname" => "Benavente","age" => "19-05-1994","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Francis","surname" => "N’Ganga","age" => "16-06-1985","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
            [
                "name" => "Club Brugge",
                "players" => [
                    ["name" => "Ludovic","surname" => "Butelle","age" => "03-04-1983","position" => Player::POSITION_GOALKEEPER],
                    ["name" => "Jose","surname" => "Izquierdo","age" => "07-07-1992","position" => Player::POSITION_ATTACKING],
                    ["name" => "Timmy","surname" => "Simons","age" => "11-12-1976","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Ruud","surname" => "Vormer","age" => "11-05-1988","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Stefano","surname" => "Denswil","age" => "07-05-1993","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
            [
                "name" => "KRC Genk",
                "players" => [
                    ["name" => "Marco","surname" => "Bizot","age" => "10-03-1991","position" => Player::POSITION_GOALKEEPER],
                    ["name" => "Leon","surname" => "Bailey","age" => "09-08-1997","position" => Player::POSITION_ATTACKING],
                    ["name" => "Thomas","surname" => "Buffel","age" => "19-02-1981","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Sander","surname" => "Berge","age" => "14-02-1998","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Omar","surname" => "Colley","age" => "24-10-1992","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
        ],
        ],

        //Poland
        "PL" => [
        "name" => "Poland",
        "teams" => [
            [
                "name" => "Legia Warszawa",
                "players" => [
                    ["name" => "Arkadiusz","surname" => "Malarz", "age" => "19-06-1980", "position" => Player::POSITION_GOALKEEPER ],
                    ["name" => "Sandro","surname" => "Kulenovic","age" => "04-12-1999","position" => Player::POSITION_ATTACKING],
                    ["name" => "Miroslav","surname" => "Radovic","age" => "16-01-1984","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Michał","surname" => "Kopczyński","age" => "15-06-1992","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Michał","surname" => "Pazdan","age" => "21-09-1987","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
            [
                "name" => "Lech Poznań",
                "players" => [
                    ["name" => "Jasmin","surname" => "Burić","age" => "18-02-1987","position" => Player::POSITION_GOALKEEPER],
                    ["name" => "Dawid","surname" => "Kownacki","age" => "14-03-1997","position" => Player::POSITION_ATTACKING],
                    ["name" => "Muhamed","surname" => "Keita","age" => "02-09-1990","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Maciej","surname" => "Makuszewski","age" => "29-09-1989","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Tomasz","surname" => "Kędziora","age" => "11-06-1994","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
            [
                "name" => "Górnik Zabrze",
                "players" => [
                    ["name" => "Grzegorz","surname" => "Kasprzik","age" => "20-09-1983","position" => Player::POSITION_GOALKEEPER],
                    ["name" => "Igor","surname" => "Angulo","age" => "26-01-1984","position" => Player::POSITION_ATTACKING],
                    ["name" => "Rafał","surname" => "Kurzawa","age" => "29-01-1993","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Szymon","surname" => "Matuszek","age" => "07-01-1989","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Rafał","surname" => "Kosznik","age" => "17-12-1983","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
            [
                "name" => "Wisła Kraków",
                "players" => [
                    ["name" => "Michał","surname" => "Miśkiewicz","age" => "20-01-1989","position" => Player::POSITION_GOALKEEPER],
                    ["name" => "Paweł","surname" => "Brożek","age" => "21-04-1983","position" => Player::POSITION_ATTACKING],
                    ["name" => "Rafał","surname" => "Boguski","age" => "09-06-1984","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Patryk","surname" => "Małecki","age" => "01-08-1988","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Iván","surname" => "González","age" => "15-02-1988","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
            [
                "name" => "Arka Gdynia",
                "players" => [
                    ["name" => "Konrad","surname" => "Jałocha","age" => "09-05-1991","position" => Player::POSITION_GOALKEEPER],
                    ["name" => "Rafał","surname" => "Siemaszko","age" => "11-09-1986","position" => Player::POSITION_ATTACKING],
                    ["name" => "Dariusz","surname" => "Formella","age" => "21-10-1995","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Mateusz","surname" => "Szwoch","age" => "19-03-1993","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Adam","surname" => "Marciniak","age" => "28-09-1988","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
        ],
        ],

        //Spain
        "ES" => [
        "name" => "Spain",
        "teams" => [
            [
                "name" => "Sevilla FC",
                "players" => [
                    ["name" => "Salvatore","surname" => "Sirigu", "age" => "12-01-1987", "position" => Player::POSITION_GOALKEEPER ],
                    ["name" => "Luciano","surname" => "Vietto","age" => "05-12-1993","position" => Player::POSITION_ATTACKING],
                    ["name" => "Hiroshi","surname" => "Kiyotake","age" => "12-11-1989","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Samir","surname" => "Nasri","age" => "26-06-1987","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Sergio","surname" => "Escudero","age" => "02-09-1989","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
            [
                "name" => "FC Barcelona",
                "players" => [
                    ["name" => "Jasper","surname" => "Cillessen","age" => "22-04-1989","position" => Player::POSITION_GOALKEEPER],
                    ["name" => "Lionel","surname" => "Messi","age" => "24-06-1987","position" => Player::POSITION_ATTACKING],
                    ["name" => "Arda","surname" => "Turan","age" => "30-01-1987","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Andrés","surname" => "Iniesta","age" => "11-05-1984","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Gerard","surname" => "Piqué","age" => "02-02-1987","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
            [
                "name" => "Atlético Madrid",
                "players" => [
                    ["name" => "Jan","surname" => "Oblak","age" => "07-01-1993","position" => Player::POSITION_GOALKEEPER],
                    ["name" => "Fernando","surname" => "Torres","age" => "20-03-1984","position" => Player::POSITION_ATTACKING],
                    ["name" => "Yannick","surname" => "Carrasco","age" => "04-09-1993","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Nicolás","surname" => "Gaitán","age" => "23-02-1988","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Diego","surname" => "Godín","age" => "16-02-1986","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
            [
                "name" => "Valencia CF",
                "players" => [
                    ["name" => "Diego","surname" => "Alves","age" => "24-06-1985","position" => Player::POSITION_GOALKEEPER],
                    ["name" => "Rodrigo","surname" => "Moreno","age" => "06-03-1991","position" => Player::POSITION_ATTACKING],
                    ["name" => "Daniel","surname" => "Parejo","age" => "16-04-1989","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Enzo","surname" => "Pérez","age" => "22-02-1986","position" => Player::POSITION_MIDFIELD],
                    ["name" => "João","surname" => "Cancelo","age" => "27-05-1994","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
            [
                "name" => "Real Madrid",
                "players" => [
                    ["name" => "Keylor","surname" => "Navas","age" => "15-12-1986","position" => Player::POSITION_GOALKEEPER],
                    ["name" => "Sergio","surname" => "Ramos","age" => "30-03-1986","position" => Player::POSITION_DEFENSIVE],
                    ["name" => "James","surname" => "Rodríguez","age" => "12-07-1991","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Toni","surname" => "Kroos","age" => "04-01-1990","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Cristiano","surname" => "Ronaldo","age" => "05-02-1985","position" => Player::POSITION_ATTACKING],
                ],
            ],
        ],
        ],

        //United Kingdom
        "UK" => [
        "name" => "United Kingdom",
        "teams" => [
            [
                "name" => "Arsenal",
                "players" => [
                    ["name" => "Petr","surname" => "Čech", "age" => "20-05-1982", "position" => Player::POSITION_GOALKEEPER ],
                    ["name" => "Alexis","surname" => "Sánchez","age" => "19-12-1988","position" => Player::POSITION_ATTACKING],
                    ["name" => "Mesut","surname" => "Özil","age" => "15-10-1988","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Granit","surname" => "Xhaka","age" => "27-09-1992","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Shkodran","surname" => "Mustafi","age" => "17-04-1992","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
            [
                "name" => "Chelsea",
                "players" => [
                    ["name" => "Thibaut","surname" => "Courtois","age" => "11-05-1992","position" => Player::POSITION_GOALKEEPER],
                    ["name" => "Diego","surname" => "Costa","age" => "07-10-1988","position" => Player::POSITION_ATTACKING],
                    ["name" => "Eden","surname" => "Hazard","age" => "07-01-1991","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Victor","surname" => "Moses","age" => "12-12-1990","position" => Player::POSITION_MIDFIELD],
                    ["name" => "David","surname" => "Luiz","age" => "22-04-1987","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
            [
                "name" => "Manchester United",
                "players" => [
                    ["name" => "David","surname" => "de Gea","age" => "07-11-1990","position" => Player::POSITION_GOALKEEPER],
                    ["name" => "Zlatan","surname" => "Ibrahimović","age" => "03-10-1981","position" => Player::POSITION_ATTACKING],
                    ["name" => "Paul","surname" => "Pogba","age" => "15-03-1993","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Henrich","surname" => "Mychitarian","age" => "21-01-1989","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Marcos","surname" => "Rojo","age" => "20-03-1990","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
            [
                "name" => "Tottenham Hotspur",
                "players" => [
                    ["name" => "Hugo","surname" => "Lloris","age" => "26-12-1986","position" => Player::POSITION_GOALKEEPER],
                    ["name" => "Harry","surname" => "Kane","age" => "28-07-1993","position" => Player::POSITION_ATTACKING],
                    ["name" => "Bamidele","surname" => "Alli","age" => "11-04-1996","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Moussa","surname" => "Dembélé","age" => "16-07-1987","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Toby","surname" => "Alderweireld","age" => "02-03-1989","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
            [
                "name" => "Liverpool",
                "players" => [
                    ["name" => "Loris","surname" => "Karius","age" => "22-06-1993","position" => Player::POSITION_GOALKEEPER],
                    ["name" => "Sadio","surname" => "Mané","age" => "10-04-1992","position" => Player::POSITION_ATTACKING],
                    ["name" => "Adam","surname" => "Lallana","age" => "10-05-1988","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Philippe","surname" => "Coutinho","age" => "12-06-1992","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Joël","surname" => "Matip","age" => "08-08-1991","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
        ],
        ],

        //Germany
        "DE" => [
        "name" => "Germany",
        "teams" => [
            [
                "name" => "Bayern Monachium",
                "players" => [
                    ["name" => "Manuel","surname" => "Neuer","age" => "27-03-1986","position" => Player::POSITION_GOALKEEPER ],
                    ["name" => "Robert","surname" => "Lewandowski","age" => "21-07-1988","position" => Player::POSITION_ATTACKING],
                    ["name" => "Arjen","surname" => "Robben","age" => "23-01-1984","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Arturo","surname" => "Vidal","age" => "22-05-1987","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Mats","surname" => "Hummels","age" => "16-12-1988","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
            [
                "name" => "Borussia Dortmund",
                "players" => [
                    ["name" => "Roman","surname" => "Bürki","age" => "14-11-1990","position" => Player::POSITION_GOALKEEPER],
                    ["name" => "Marco","surname" => "Reus","age" => "31-05-1989","position" => Player::POSITION_ATTACKING],
                    ["name" => "Mario","surname" => "Götze","age" => "03-06-1992","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Shinji","surname" => "Kagawa","age" => "17-03-1989","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Raphaël","surname" => "Guerreiro","age" => "22-12-1993","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
            [
                "name" => "Eintracht Frankfurt",
                "players" => [
                    ["name" => "Lukas","surname" => "Hradecky","age" => "24-11-1989","position" => Player::POSITION_GOALKEEPER],
                    ["name" => "Alexander","surname" => "Meier","age" => "17-01-1983","position" => Player::POSITION_ATTACKING],
                    ["name" => "Marco","surname" => "Fabián","age" => "21-07-1989","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Makoto","surname" => "Hasebe","age" => "18-01-1984","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Jesús","surname" => "Vallejo","age" => "05-01-1997","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
            [
                "name" => "Werder Brema",
                "players" => [
                    ["name" => "Felix","surname" => "Wiedwald","age" => "15-03-1990","position" => Player::POSITION_GOALKEEPER],
                    ["name" => "Claudio","surname" => "Pizarro","age" => "03-10-1978","position" => Player::POSITION_ATTACKING],
                    ["name" => "Serge","surname" => "Gnabry","age" => "14-07-1995","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Thomas","surname" => "Delaney","age" => "03-09-1991","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Clemens","surname" => "Fritz","age" => "07-12-1980","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
            [
                "name" => "KRC Hannover 96",
                "players" => [
                    ["name" => "Samuel","surname" => "Radlinger","age" => "07-11-1992","position" => Player::POSITION_GOALKEEPER],
                    ["name" => "Artur","surname" => "Sobiech","age" => "12-06-1990","position" => Player::POSITION_ATTACKING],
                    ["name" => "Manuel","surname" => "Schmiedebach","age" => "05-12-1988","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Felix","surname" => "Klaus","age" => "13-09-1992","position" => Player::POSITION_MIDFIELD],
                    ["name" => "Miiko","surname" => "Albornoz","age" => "30-11-1990","position" => Player::POSITION_DEFENSIVE],
                ],
            ],
        ],
        ],
    ];

    public function load(ObjectManager $manager)
    {
        //3 nested loops can be unclear to read but it is nice way to create simple dependent data set like this
        foreach ($this->data as $code => $countryData){
            //create countries
            $country = new Country();
            $country->setCode($code);
            $country->setName($countryData["name"]);
            $manager->persist($country);

            foreach ($countryData["teams"] as $teamData){
                //create teams
                $team = new Team();
                $team->setName($teamData["name"]);
                $team->setCountry($country);
                $manager->persist($team);

                foreach ($teamData["players"] as $playerData){
                    //create players for each team
                    $player = new Player();
                    $player->setName($playerData["name"]);
                    $player->setSurname($playerData["surname"]);

                    $fullName = $playerData["name"] . " " . $playerData["surname"];
                    $slugged = Sluggable\Urlizer::urlize($fullName, ' ');
                    $player->setSlug($slugged);

                    $date = \DateTime::createFromFormat('d-m-Y', trim($playerData["age"]));
                    $player->setBirthday($date);

                    $player->setPosition($playerData["position"]);
                    $player->setTeam($team);
                    $manager->persist($player);
                }
            }

            $manager->flush();
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}