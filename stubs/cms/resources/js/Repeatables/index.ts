import Text from './Text.vue'
import Image from './Image.vue'
import InfoBox from './InfoBox.vue'
import Cards from './Cards/Cards.vue'
import Card from './Cards/Card.vue'
import SectionAside from './SectionAside/SectionAside.vue'
import Accordion from './Accordion/Accordion.vue'
import ImageText from './ImageText.vue'

export const ContentRepeatables = {
    Text: Text,
    Image: Image,
    InfoBox: InfoBox,
    SectionCards: Cards,
    SectionAside: SectionAside,
    Accordion: Accordion,
    ImageText: ImageText,
};

export const CardRepeatables = {
    card: Card,
};

export const AsideRepeatables = {
    Text: Text,
    Image: Image,
    InfoBox: InfoBox,
};