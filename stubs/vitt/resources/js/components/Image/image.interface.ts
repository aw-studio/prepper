interface ConversionUrl {
    [key: string]: string;
}

interface GeneratedConversion {
    [key: string]: boolean;
}

interface Image {
    collection_name: string;
    conversion_urls: ConversionUrl;
    conversions_disk: string;
    created_at: string;
    custom_properties: any;
    disk: string;
    file_name: string;
    generated_conversions: GeneratedConversion;
    id: number;
    manipulations: [];
    mime_type: string;
    model_id: number;
    model_type: string;
    name: string;
    order_column: number;
    original_url: string;
    responsive_images: [];
    size: number;
    updated_at: string;
    url: string;
    uuid: string;
}

export {
    Image
}