<?php

namespace Database\Seeders\Structure;

use App\Domains\Structure\Models\Activity;
use App\Domains\Responses\Models\Response;
use Database\Seeders\Traits\DisableForeignKeys;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

/**
 * Class ActivityTableSeeder.
 */
class ActivitySeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        if (app()->environment(['local', 'testing'])) {
            $this->addTestActivity(1, 3, Response::TYPE_CLICK);
            $this->addTestActivity(2, 2, Response::TYPE_CLICK);
            $this->addTestActivity(3, 2, Response::TYPE_CLICK);
            $this->addTestActivity(4, 1, Response::TYPE_CLICK);
            $this->addTestActivity(5, 1, Response::TYPE_CLICK);
            $this->addTestActivity(6, 1, Response::TYPE_T);
            $this->addTestActivity(7, 1, Response::TYPE_T_I);
            $this->addTestActivity(8, 1, Response::TYPE_T_I);
            $this->addTestActivity(9, 1, Response::TYPE_T_V);
            $this->addTestActivity(10, 1, Response::TYPE_T_V);
            $this->addTestActivity(1, 2, Response::TYPE_T_V);
            $this->addTestActivity(2, 2, Response::TYPE_T_V);
            $this->addTestActivity(3, 2, Response::TYPE_T_I);
            $this->addTestActivity(4, 2, Response::TYPE_T_I);
            $this->addTestActivity(5, 2, Response::TYPE_T_V);
            $this->addTestActivity(6, 2, Response::TYPE_T_I);
            $this->addTestActivity(7, 2, Response::TYPE_T_V);
            $this->addTestActivity(9, 2, Response::TYPE_T_V);
            $this->addTestActivity(10, 2, Response::TYPE_T_I);
            $this->addTestActivity(2, 3, Response::TYPE_T_I);
            $this->addTestActivity(3, 3, Response::TYPE_T_V);
            $this->addTestActivity(4, 3, Response::TYPE_T_V);
            $this->addTestActivity(5, 4, Response::TYPE_T_I);
            $this->addTestActivity(6, 4, Response::TYPE_T_V);

            $this->addFinalActivity1();
            $this->addFinalActivity2();
        }

        $this->enableForeignKeys();
    }

    private function addTestActivity($number, $category_id, $type_id)
    {
        $faker = Faker::create('es_ES');
        $cardContent = $faker->realText(300);
        $introContent = $faker->realText(500);
        $individualContent = $faker->realText(1000);
        $collectiveContent = $faker->realText(1000);
        $activity = Activity::create([
            'category_id' => $category_id,
            'title' => 'Actividad de prueba '.$number,
            'card_content' => $cardContent,
            'intro_content' => $introContent,
            'individual_content' => $individualContent,
            'individual_type_id' => Response::TYPE_CLICK,
            'collective_content' => $collectiveContent,
            'collective_type_id' => $type_id,
            'order' => $number,
            'published' => true,
            'active' => true,

        ]);

        $path = base_path().'/database/assets/img/activities/';
        $activity->addMedia($path.'header'.$number.'.jpg')
            ->usingName('Imagen de cabecera '.$number)
            ->preservingOriginal()
            ->toMediaCollection('image_header');

        $activity->addMedia($path.'card'.$number.'.jpg')
            ->usingName('Imagen '.$number)
            ->preservingOriginal()
            ->toMediaCollection('image_card');
    }

    private function addFinalActivity1()
    {
        $activity = Activity::create([
            'category_id' => 1,
            'title' => '«La gratitud no es solo la más grande de las virtudes, sino la madre de todas las demás.» —Cicerón,',
            'card_content' => '<p style="margin: 13.5pt 0cm 0cm; font-size: 12pt; font-family: &quot;Times New Roman&quot;, serif; color: rgb(0, 0, 0); text-align: justify; line-height: 18.4px;"><span lang="ES-TRAD" style="font-family: Cambria, serif;"><span style="font-family: &quot;Helvetica Neue&quot;;">Piensa en el día de hoy. ¿Te has parado a pensar o a agradecer por todo lo que tienes o por lo que te rodea en algún momento?&nbsp; ¿Cuántas veces has mostrado tu agradecimiento hacia las personas con las que has interactuado a lo largo del día?...</span><o:p></o:p></span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD"><span style="font-family: &quot;Helvetica Neue&quot;;">El agradecimiento es una actitud de reconocimiento de las cosas buenas&nbsp;que nos suceden y es fundamental para nuestro propio bienestar. Hoy te animamos a practicar la gratitud de manera consciente en tu vida.</span><o:p></o:p></span></p>',
            'intro_content' => '<p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0); line-height: 18.4px;"><span lang="ES-TRAD" style="letter-spacing: -0.05pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-family: &quot;Helvetica Neue&quot;;">Ser agradecido es esencial para apreciar y disfrutar plenamente la vida. Agradecer lo que somos, lo que hemos conseguido, lo que tenemos, las personas que nos rodean, etc. Nos hace vivir en armonía con nuestro entorno y con un alto grado de bienestar, y nos ayuda a mantener nuestra </span><b>felicidad</b><span style="font-family: &quot;Helvetica Neue&quot;;"> así como también un estado de bienestar.</span><o:p></o:p></span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0); line-height: 18.4px;"><span lang="ES-TRAD" style="letter-spacing: -0.05pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;">&nbsp;</span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0); line-height: 18.4px;"><span lang="ES-TRAD" style="background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: &quot;Helvetica Neue&quot;;">Cuando uno vive expresando&nbsp;</span><b><span lang="ES-TRAD" style="font-family: &quot;Helvetica Neue&quot;;">gratitud&nbsp;</span></b><span lang="ES-TRAD" style="background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: &quot;Helvetica Neue&quot;;">es capaz de valorar todo lo que tiene a su alrededor, como la naturaleza, las personas o las experiencias, por pequeñas que sean. Quienes expresan gratitud&nbsp;</span><b><span lang="ES-TRAD" style="font-family: &quot;Helvetica Neue&quot;;">viven con atención plena aquellos detalles del día a día</span></b><span lang="ES-TRAD" style="background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><span style="font-family: &quot;Helvetica Neue&quot;;">&nbsp;que a muchas otras personas se les escapan.</span><o:p></o:p></span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0); line-height: 18.4px;"><span lang="ES-TRAD" style="background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;">&nbsp;</span></p><p style="margin: 13.5pt 0cm 0cm; font-size: 12pt; font-family: &quot;Times New Roman&quot;, serif; color: rgb(0, 0, 0); text-align: justify; line-height: 18.4px;"><span lang="ES-TRAD" style="font-family: Cambria, serif;"><span style="font-family: &quot;Helvetica Neue&quot;;">Las personas acostumbradas a agradecer los pequeños gestos cotidianos son más atentas y creativas, tienen un mejor concepto de su propio cuerpo y siguen un</span><span class="apple-converted-space">&nbsp;</span><strong>estilo de vida más saludable</strong><span style="font-family: &quot;Helvetica Neue&quot;;">, de forma natural y con un menor esfuerzo.</span><o:p></o:p></span></p><p style="margin: 13.5pt 0cm 0cm; font-size: 12pt; font-family: &quot;Times New Roman&quot;, serif; color: rgb(0, 0, 0); text-align: justify; line-height: 18.4px;"><span lang="ES-TRAD" style="font-family: Cambria, serif;">&nbsp;</span></p>',
            'individual_content' => '<p style="margin: 13.5pt 0cm 0cm; font-size: 12pt; font-family: &quot;Times New Roman&quot;, serif; color: rgb(0, 0, 0); text-align: justify; line-height: 18.4px;"><span lang="ES-TRAD" style="font-family: Cambria, serif;"><span style="font-family: &quot;Helvetica Neue&quot;;">El agradecimiento es una actitud de reconocimiento de las cosas buenas&nbsp;que nos suceden. Y por otro, la expresión de esta gratitud. Si no apreciamos lo bueno que nos pasa, no podemos estar agradecidos.</span><o:p></o:p></span></p><p style="margin: 13.5pt 0cm 0cm; font-size: 12pt; font-family: &quot;Times New Roman&quot;, serif; color: rgb(0, 0, 0); text-align: justify; line-height: 18.4px;"><span lang="ES-TRAD" style="font-family: Cambria, serif;"><span style="font-family: &quot;Helvetica Neue&quot;;">El problema es que muchas veces no sabemos apreciarlo. En algunas ocasiones no somos conscientes de ver lo bueno, sencillamente porque lo damos por supuesto o estamos únicamente pendientes de las cosas negativas.</span><o:p></o:p></span></p><p style="margin: 13.5pt 0cm 0cm; font-size: 12pt; font-family: &quot;Times New Roman&quot;, serif; color: rgb(0, 0, 0); text-align: justify; line-height: 18.4px;"><span lang="ES-TRAD" style="font-family: Cambria, serif;"><span style="font-family: &quot;Helvetica Neue&quot;;">La gratitud representa una&nbsp;habilidad&nbsp;primordial para desarrollar y mantener niveles adecuados de&nbsp;bienestar emocional, satisfacción y calidad de vida.</span><o:p></o:p></span></p><p style="margin: 13.5pt 0cm 0cm; font-size: 12pt; font-family: &quot;Times New Roman&quot;, serif; color: rgb(0, 0, 0); text-align: justify; line-height: 18.4px;"><span lang="ES-TRAD" style="font-family: Cambria, serif;"><span style="font-family: &quot;Helvetica Neue&quot;;">A continuación te animamos a que realices los siguientes ejercicios para ejercitar esta virtud, y a ser posible, que los conviertas en un hábito o en una costumbre en tu día a día. </span><b><span style="font-family: &quot;Helvetica Neue&quot;;">El verdadero desafío es conseguir que la gratitud se convierta en un hábito.</span><o:p></o:p></b></span></p><p style="margin: 13.5pt 0cm 0cm; font-size: 12pt; font-family: &quot;Times New Roman&quot;, serif; color: rgb(0, 0, 0); text-align: justify; line-height: 18.4px;"><b><span lang="ES-TRAD" style="font-family: Cambria, serif;"><span style="font-family: &quot;Courier New&quot;;">“Descargar pdf ejercicios”</span><o:p></o:p></span></b></p><p style="margin: 13.5pt 0cm 0cm; font-size: 12pt; font-family: &quot;Times New Roman&quot;, serif; color: rgb(0, 0, 0); text-align: justify; line-height: 18.4px;"><span lang="ES-TRAD" style="font-family: &quot;Helvetica Neue&quot;;">Cuando los hayas realizado estamos seguros de que estarás preparado para lo que vamos a proponerte. Queremos animarte a que </span><b>envíes uno o varios&nbsp; emails de agradecimiento a uno o varios compañeros</b><span style="font-family: &quot;Helvetica Neue&quot;;"> que te hayan ayudado a lo largo de tu carrera profesional.</span><span lang="ES-TRAD" style="font-family: Cambria, serif;"><o:p></o:p></span></p><p class="MsoNormal" style="margin: 0cm 0cm 26.25pt; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0); line-height: 18pt; vertical-align: baseline;"><span lang="ES-TRAD"><span style="font-family: &quot;Helvetica Neue&quot;;">Seguro que encuentras muchos motivos para agradecer la labor de tus compañeros&nbsp; a lo largo de tu trayectoria en la empresa.</span><o:p></o:p></span></p><p style="margin: 13.5pt 0cm 0cm; font-size: 12pt; font-family: &quot;Times New Roman&quot;, serif; color: rgb(0, 0, 0); text-align: justify; line-height: 18.4px;"><br></p>',
            'individual_type_id' => Response::TYPE_CLICK,
            'collective_content' => '<p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD"><span style="font-family: &quot;Helvetica Neue&quot;;">Ahora que ya te has vuelto un experto en esto de la gratitud, seguro que te animas a ponerlo en práctica&nbsp; con el resto de tus compañeros de trabajo.</span><o:p></o:p></span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD">&nbsp;</span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD"><span style="font-family: &quot;Helvetica Neue&quot;;">Te animamos&nbsp; que compartas en el muro alguna o todas de las siguientes opciones que te planteamos a continuación.</span><o:p></o:p></span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD">&nbsp;</span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD"><span style="font-family: &quot;Helvetica Neue&quot;;">-Los nombres de&nbsp; las compañeros a los que tienes algo que agradecerles y el motivo por el cuál tienes algo que agradecerles.</span><o:p></o:p></span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD"><span style="font-family: &quot;Helvetica Neue&quot;;">-Los motivos&nbsp; por los cuáles te sientes agradecido de formar parte de este equipo o de trabajar en esta empresa.</span><o:p></o:p></span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD"><span style="font-family: &quot;Helvetica Neue&quot;;">-Mide tu nivel de gratitud a través de este cuestionario y comparte tu resultado con el resto de compañeros.</span><o:p></o:p></span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD">&nbsp;</span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><br></p>',
            'collective_type_id' => Response::TYPE_T_V,
            'order' => 0,
            'published' => true,
            'active' => true,

        ]);

        $path = base_path().'/database/assets/img/activities/';
        $activity->addMedia($path.'final-header1.jpg')
            ->usingName('Imagen de cabecera')
            ->preservingOriginal()
            ->toMediaCollection('image_header');

        $activity->addMedia($path.'final-card1.jpg')
            ->usingName('Imagen')
            ->preservingOriginal()
            ->toMediaCollection('image_card');
    }

    private function addFinalActivity2()
    {
        $activity = Activity::create([
            'category_id' => 3,
            'title' => '“Un día sin reír es un día perdido” —Charles Chaplin',
            'card_content' => '<p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD" style="font-family: Helvetica; color: rgb(80, 80, 80); border: 1pt none windowtext; padding: 0cm;">La risa es contagiosa, liberadora, desestresante</span><span lang="ES-TRAD" style="font-family: Helvetica; color: rgb(80, 80, 80); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;">, pero, además, se ha demostrado científicamente que sus&nbsp;</span><span lang="ES-TRAD" style="font-family: Helvetica; color: rgb(80, 80, 80); border: 1pt none windowtext; padding: 0cm;">beneficios para la salud y el bienestar</span><span lang="ES-TRAD" style="font-family: Helvetica; color: rgb(80, 80, 80); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;">&nbsp;de las personas son claves en muchas facetas de su vida.</span><span lang="ES-TRAD" style="font-family: Times;"><o:p></o:p></span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD">&nbsp;</span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD" style="font-family: Helvetica; color: rgb(80, 80, 80); border: 1pt none windowtext; padding: 0cm;">La risa ejercita los músculos de la cara</span><span lang="ES-TRAD" style="font-family: Helvetica; color: rgb(80, 80, 80); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;">, no arruga ni causa líneas de expresión. ¿Sabías que cuando nos reímos movemos 400 músculos del cuerpo, y que&nbsp;</span><span lang="ES-TRAD" style="font-family: Helvetica; color: rgb(80, 80, 80); border: 1pt none windowtext; padding: 0cm;">100 carcajadas equivalen a hacer 10 minutos de ejercicio aeróbico o 15 minutos de bicicleta?</span><span lang="ES-TRAD" style="font-family: Helvetica; color: rgb(80, 80, 80); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;">. Además, cuando estamos contentos, se refleja en el estado físico y la apariencia es mucho mejor.<o:p></o:p></span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD" style="font-family: Helvetica; color: rgb(80, 80, 80); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;">&nbsp;</span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD" style="font-family: Helvetica; color: rgb(80, 80, 80); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;">Hoy queremos animarte a que practiques el deporte de reír verás que bien sienta.<o:p></o:p></span></p>',
            'intro_content' => '<p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD"><span style="font-family: &quot;Helvetica Neue&quot;;">La risa es un proceso biológico que nos ayuda a liberar endorfinas además de ayudarnos a sentirnos mejor y mejorar la imagen que podamos tener de nosotros mismos.</span><o:p></o:p></span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD">&nbsp;</span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD"><span style="font-family: &quot;Helvetica Neue&quot;;">La risa permite experimentar alivio y alegría. También ayuda a sentirnos más ligeros y a contagiar a otros esa sensación y sobre todo esa ENERGÍA positiva.&nbsp;</span><o:p></o:p></span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD">&nbsp;</span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD"><span style="font-family: &quot;Helvetica Neue&quot;;">Sonríe más hacia las personas con las que interactúas a diario, y a cambio obtendrás más sonrisas. Te sentirás mejor. No esperes a que otras personas sonrían más, sé la sonrisa que quieres ver en tu mundo.</span></span></p>',
            'individual_content' => '<p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD"><span style="font-family: &quot;Helvetica Neue&quot;;">Te retamos a que observes este video y hagas los siguientes ejercicios para ejercitar tu risa. Porque la risa puede y debe ejercitarse de la misma manera que ejercitamos nuestros músculos y nuestro cerebro.</span><o:p></o:p></span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD">&nbsp;</span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD"><span style="font-family: &quot;Helvetica Neue&quot;;">A medida que vayas avanzando en los ejercicios,&nbsp; sentirás que te invaden unas ganas incontrolables&nbsp; de reír. Porque no hay nada mejor que ponerle un poco de humor a la vida ¿No crees?</span><o:p></o:p></span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD">&nbsp;</span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD"><span style="font-family: &quot;Helvetica Neue&quot;;">“Ver video”</span><o:p></o:p></span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD">&nbsp;</span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD">&nbsp;</span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD"><span style="font-family: &quot;Helvetica Neue&quot;;">Seguro que a estas alturas tienes alguna anécdota divertida que te haya pasado en el trabajo. , ¿Qué tal si la recuperas y se la cuentas a alguno de tus compañeros? Seguro que consigues sacarle una sonrisa a más de uno.</span><o:p></o:p></span></p>',
            'individual_type_id' => Response::TYPE_CLICK,
            'collective_content' => '<p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD"><span style="font-family: &quot;Helvetica Neue&quot;;">Ahora que has calentado motores en esto de las carcajadas, seguro que te animas a ponerlo en práctica&nbsp; con el resto de tus compañeros de trabajo.</span><o:p></o:p></span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD">&nbsp;</span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD"><span style="font-family: &quot;Helvetica Neue&quot;;">Hoy te retamos a que compartas en el muro alguna o todas las opciones que te planteamos a continuación.</span><o:p></o:p></span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><b><span lang="ES-TRAD">&nbsp;</span></b></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD">&nbsp;</span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD"><span style="font-family: &quot;Helvetica Neue&quot;;">-Todos tenemos esos momentos en los que nos hemos venido arriba perdiendo nuestro sentido del ridículo, si tienes una imagen que captó uno de esos momentos hoy te animamos a que la compartas con tus compañeros. La única condición es que nos haga reír.</span><o:p></o:p></span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD">&nbsp;</span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD"><span style="font-family: &quot;Helvetica Neue&quot;;">-Puede que hoy te sientas inspirado para hacer esa foto divertida, ¡venga, no te lo pienses mucho y dale al botón!</span><o:p></o:p></span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD">&nbsp;</span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD"><span style="font-family: &quot;Helvetica Neue&quot;;">Además la foto más votada &nbsp;&nbsp;tendrá premio. &nbsp;¿Te animas?</span><o:p></o:p></span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD">&nbsp;</span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD"><span style="font-family: &quot;Helvetica Neue&quot;;">-Comparte esa película que por muchas veces que la veas te siga pareciendo tronchante. Si escoger una te resulta difícil, te dejamos que nos pongas&nbsp; las 3 películas, que para ti, son las más divertidas de la historia.</span><o:p></o:p></span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD">&nbsp;</span></p><p class="MsoNormal" style="margin: 0cm; font-size: 12pt; font-family: Cambria, serif; color: rgb(0, 0, 0);"><span lang="ES-TRAD"><span style="font-family: &quot;Helvetica Neue&quot;;">Podríamos crear nuestro propio listado de las películas más divertidas a partir de los comentarios de todos. ¿Qué te parece?</span><o:p></o:p></span></p>',
            'collective_type_id' => Response::TYPE_T_LINK,
            'order' => 0,
            'published' => true,
            'active' => true,

        ]);

        $path = base_path().'/database/assets/img/activities/';
        $activity->addMedia($path.'header2.jpg')
            ->usingName('Imagen de cabecera')
            ->preservingOriginal()
            ->toMediaCollection('image_header');

        $activity->addMedia($path.'card2.jpg')
            ->usingName('Imagen')
            ->preservingOriginal()
            ->toMediaCollection('image_card');
    }
}
