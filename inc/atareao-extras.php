<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package atareao_theme_v2
 */
function atareao_theme_v2_rememoration_day(){
    $url="";
    $ribbon="";
    $tag="";		
    switch (date("md")) {
        case "0127":
        $url="D%C3%ADa_Internacional_de_Conmemoraci%C3%B3n_en_Memoria_de_las_V%C3%ADctimas_del_Holocausto";
        $ribbon="negro";
        $tag="Día internacional de conmemoración en memoria de las víctimas del holocausto";
        break;
        case "0107":
        $url="Nikola_Tesla";
        $ribbon="negro";
        $tag="Aniversario del fallecimiento de Nikola Tesla";
        break;
        case "0108":
        $url="Galileo_Galilei";
        $ribbon="negro";
        $tag="Aniversario del fallecimiento de Galileo Galilei";
        break;
        case "0126":
        $url="Edward_Jenner";
        $ribbon="negro";
        $tag="Aniversario del fallecimiento de Edward Jenner";
        break;
        case "0201":
        $url="Werner_Heisenberg";
        $ribbon="negro";
        $tag="Aniversario del fallecimiento de Werner Heisenberg";
        break;
        case "0204":
        $url="D%C3%ADa_Mundial_contra_el_C%C3%A1ncer";
        $ribbon="fucsia";
        $tag="Día mundial contra el cáncer";
        break;
        case "0206":
        $url="D%C3%ADa_Internacional_de_Tolerancia_Cero_con_la_Mutilaci%C3%B3n_Genital_Femenina";
        $ribbon="negro";
        $tag="Día internacional de tolerancia cero con la mutilación genital femenina";
        break;
        case "0210":
        $url="Wilhelm_Röntgen";
        $ribbon="negro";
        $tag="Aniversario del fallecimiento de Wilhelm Röntgen";
        break;
        case "0215":
        $url="D%C3%ADa_Internacional_del_C%C3%A1ncer_Infantil";
        $ribbon="fucsia";
        $tag="Día interancional del cáncer infantil";
        break;
        case "0225":
        $url="Paco_de_Luc%C3%ADa";
        $ribbon="negro";
        $tag="Aniversario del fallecimiento de Paco de Lucía";
        break;
        case "0302":
        $url="Azor%C3%ADn";
        $ribbon="negro";
        $tag="Aniversario del fallecimiento de Azorín";
        break;
        case "0303":
        $url="D%C3%ADa_Mundial_de_la_Naturaleza";
        $ribbon="verde";
        $tag="Día mundial de la naturaleza";
        break;
        case "0308":
        $url="D%C3%ADa_Internacional_de_la_Mujer";
        $ribbon="rosa";
        $tag="Día internacional de la mujer";
        break;
        case "0311":
        $url="Atentados_del_11_de_marzo_de_2004";
        $ribbon="negro";
        $tag="Aniversario de los atentados del 11 de marzo de 2004";
        break;
        case "0312":
        $url="D%C3%ADa_Mundial_del_Glaucoma";
        $tag="Día mundial del glaucoma";
        $ribbon="verde";
        break;
        case "0313":
        case "0315":
        case "0316":
        case "0317":
        case "0318":
        case "0319":
        $url="Fallas_de_Valencia";
        $ribbon="fallas";
        $tag="Fallas de Valencia";
        break;
        case "0320":
        $url="Isaac_Newton";
        $ribbon="negro";
        $tag="Aniversario del fallecimiento de Isaac Newton";
        break;
        case "0324":
        $url="D%C3%ADa_Mundial_de_la_Tuberculosis";
        $ribbon="rojo";
        $tag="Día mundial de la tuberculosis";
        break;
        case "0326":
        $url="Ludwig_van_Beethoven";
        $ribbon="negro";
        $tag="Aniversario del fallecimiento de Ludwing Van Beethoven";
        break;
        case "0407":
        $url="Dia_Mundial_de_la_Salud";
        $ribbon="verde";		
        $tag="Día mundial de la salud";
        case "0418":
        $url="Albert_Einstein";
        $tag="Aniversario del fallecimiento de Albert Einstein";
        $ribbon="negro";
        break;
        case "0428":
        $url="D%C3%ADa_Mundial_de_la_Seguridad_y_Salud_en_el_Trabajo";
        $ribbon="verde";
        $tag="Día mundial de la seguridad y salud en el trabajo";
        case "0510":
        $url="D%C3%ADa_Mundial_del_Lupus";
        $ribbon="naranja";
        $tag="Día mundial del lupus";
        break;
        case "0512":
        $url="D%C3%ADa_Internacional_de_la_Fibromialgia";
        $ribbon="morado";
        $tag="Día internacional de la fibromialgia";
        break;
        case "0520":
        $url="Cristóbal_Colón";
        $ribbon="negro";
        $tag="Aniversario del fallecimiento de Cristobal Colón";
        break;
        case "0605":
        $url="D%C3%ADa_Mundial_del_Medio_Ambiente";
        $ribbon="verde";
        $tag="Día mundial del medio ambiente";
        break;
        case "0614":
        $url="D%C3%ADa_Mundial_del_Donante_de_Sangre";
        $ribbon="rojo";
        $tag="Día mundial del donante de sangre";
        break;
        case "0713":
        $url="Miguel_Ángel_Blanco";
        $ribbon="negro";
        $tag="Aniversario del fallecimiento de Miguel Angel Blanco";
        break;
        case "0727":
        $url="John_Dalton";
        $ribbon="negro";
        $tag="Aniversario del fallecimiento de John Dalton";
        break;
        case "0728":
        $url="D%C3%ADa_Mundial_contra_la_Hepatitis";
        $ribbon="amarillo";
        $tag="Día mundial contra la hepatitis";
        break;
        case "0815":
        $url="Benito_Villamarín";
        $tag="Aniversario del fallecimiento de Benito Villamarín";
        $ribbon="negro";
        break;
        case "0823":
        $url="D%C3%ADa_Europeo_de_Conmemoraci%C3%B3n_de_las_V%C3%ADctimas_del_Estalinismo_y_el_Nazismo";
        $ribbon="negro";
        $tag="Día europeo de conmemoración de las víctimas del estalinismo y el nazismo";
        break;
        case "0825":
        $url="James_Watt";
        $ribbon="negro";
        $tag="Aniversario del fallecimiento de James Watt";
        break;
        case "0826":
        $url="Anton_van_Leeuwenhoek";
        $ribbon="negro";
        $tag="Aniversario del fallecimiento de Anton Van Leeuwenhoek";
        break;
        case "0911":
        $url="Atentados_del_11_de_septiembre_de_2001";
        $ribbon="negro";
        $tag="Aniversario de los atentados del 11 de septiembre de 2001";
        break;
        case "0921":
        $url="D%C3%ADa_Internacional_de_la_Paz";
        $ribbon="blanco";
        $tag="Día internacional de la paz";
        break;
        case "0927":
        $url="https://es.wikipedia.org/wiki/Equivalencia_entre_masa_y_energ%C3%ADa#Art.C3.ADculo_de_Einstein_de_1905";
        $ribbon="blanco";
        $tag="Artículo de Einstein de 1905";		
        break;
        case "0928":
        $url="Louis_Pasteur";
        $ribbon="negro";
        $tag="Aniversario del fallecimiento de Louis Pasteur";
        break;
        case "0929":
        $url="D%C3%ADa_Mundial_del_Coraz%C3%B3n";
        $ribbon="rojo";
        $tag="Día mundial del corazón";
        break;
        case "1004":
        $url="Max_Planck";
        $ribbon="negro";
        $tag="Aniversario del fallecimiento de Max Planck";
        break;
        case "1010":
            $url="D%C3%ADa_Mundial_de_la_Salud_Mental";
            $ribbon="gris";
            $tag="Día mundial de la salud mental";
            break;
        case "1019":
            $url="Cáncer_de_mama";
            $ribbon="rosa";
            $tag="Día Mundial del Cáncer de Mama";
            break;
        case "1105":
            $url="James_Clerk_Maxwell";
            $ribbon="negro";
            $tag="Aniversario del fallecimiento de James Clerk Maxwell";
            break;
        case "1113":
            $url="Atentados_de_Par%C3%ADs_de_noviembre_de_2015";
            $ribbon="negro";
            $tag="Atentados de París";
            break;
        case "1114":
            $url="D%C3%ADa_Mundial_de_la_Diabetes";
            $ribbon="gris";
            $tag="Día mundial de la diabetes";
            break;
        case "1201":
            $url="D%C3%ADa_Mundial_de_la_Lucha_contra_el_Sida";
            $ribbon="rojo";
            $tag="Día mundial de la lucha contra el sida";
            break;
    }
    if($url != ""){
            $ribbon_url = get_template_directory_uri ().'/images/lazos/lazo_'.$ribbon .'.png'; 
            echo "<div class='ribbon'><a href='http://es.wikipedia.org/wiki/" . $url . "'><img class='lazo' src='".$ribbon_url."' alt='" . $tag . "' title='" . $tag . "'></a></div>";	
    }
}