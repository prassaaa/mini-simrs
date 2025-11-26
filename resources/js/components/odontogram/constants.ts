// Konstanta untuk kondisi gigi
export const KONDISI_GIGI: Record<string, { label: string; image: string }> = {
    'sou': { label: 'Sound (Normal)', image: 'sou.png' },
    'car': { label: 'Caries (Karies)', image: 'car.png' },
    'amf': { label: 'Amalgam Filling', image: 'amf.png' },
    'amf-rct': { label: 'Amalgam + Root Canal', image: 'amf-rct.png' },
    'cof-1': { label: 'Composite Filling 1', image: 'cof-1.png' },
    'cof-2': { label: 'Composite Filling 2', image: 'cof-2.png' },
    'cof-rct': { label: 'Composite + Root Canal', image: 'cof-rct.png' },
    'fmc': { label: 'Full Metal Crown', image: 'fmc.png' },
    'fmc-rct': { label: 'Full Metal Crown + RCT', image: 'fmc-rct.png' },
    'poc': { label: 'Porcelain Crown', image: 'poc.png' },
    'poc-rct': { label: 'Porcelain Crown + RCT', image: 'poc-rct.png' },
    'rct': { label: 'Root Canal Treatment', image: 'rct.png' },
    'mis': { label: 'Missing (Hilang)', image: 'mis.png' },
    'non': { label: 'Non-vital', image: 'non.png' },
    'nvt': { label: 'Non-vital', image: 'nvt.png' },
    'ano': { label: 'Anomali', image: 'ano.png' },
    'rrx': { label: 'Sisa Akar', image: 'rrx.png' },
    'une': { label: 'Un-erupted', image: 'une.png' },
    'pre': { label: 'Partial Erupt', image: 'pre.png' },
    'fis': { label: 'Pit & Fissure Sealant', image: 'fis.png' },
    'cfr': { label: 'Fracture', image: 'cfr.png' },
    'frm-acr': { label: 'Partial/Full Denture', image: 'frm-acr.png' },
    'ipx-poc': { label: 'Implant + Porcelain', image: 'ipx-poc.png' },
    'meb-left': { label: 'Metal Bridge (Kiri)', image: 'meb-left.png' },
    'meb-center': { label: 'Metal Bridge (Tengah)', image: 'meb-center.png' },
    'meb-right': { label: 'Metal Bridge (Kanan)', image: 'meb-right.png' },
    'mcb-left': { label: 'Metal Cantilever (Kiri)', image: 'mcb-left.png' },
    'mcb-right': { label: 'Metal Cantilever (Kanan)', image: 'mcb-right.png' },
    'pob-left': { label: 'Porcelain Bridge (Kiri)', image: 'pob-left.png' },
    'pob-center': { label: 'Porcelain Bridge (Tengah)', image: 'pob-center.png' },
    'pob-right': { label: 'Porcelain Bridge (Kanan)', image: 'pob-right.png' },
    'migrasi-left': { label: 'Migrasi Kiri', image: 'migrasi-left.png' },
    'migrasi-right': { label: 'Migrasi Kanan', image: 'migrasi-right.png' },
    'rotasi-arahjam': { label: 'Rotasi Searah Jam', image: 'rotasi-arahjam.png' },
    'rotasi-balikjam': { label: 'Rotasi Berlawanan Jam', image: 'rotasi-balikjam.png' },
};

// Gigi dewasa - Rahang atas
export const GIGI_DEWASA_ATAS_KANAN = ['18', '17', '16', '15', '14', '13', '12', '11'];
export const GIGI_DEWASA_ATAS_KIRI = ['21', '22', '23', '24', '25', '26', '27', '28'];

// Gigi dewasa - Rahang bawah
export const GIGI_DEWASA_BAWAH_KANAN = ['48', '47', '46', '45', '44', '43', '42', '41'];
export const GIGI_DEWASA_BAWAH_KIRI = ['31', '32', '33', '34', '35', '36', '37', '38'];

// Gigi susu - Rahang atas
export const GIGI_SUSU_ATAS_KANAN = ['55', '54', '53', '52', '51'];
export const GIGI_SUSU_ATAS_KIRI = ['61', '62', '63', '64', '65'];

// Gigi susu - Rahang bawah
export const GIGI_SUSU_BAWAH_KANAN = ['85', '84', '83', '82', '81'];
export const GIGI_SUSU_BAWAH_KIRI = ['71', '72', '73', '74', '75'];

// All gigi arrays
export const ALL_GIGI_DEWASA = [
    ...GIGI_DEWASA_ATAS_KANAN,
    ...GIGI_DEWASA_ATAS_KIRI,
    ...GIGI_DEWASA_BAWAH_KIRI,
    ...GIGI_DEWASA_BAWAH_KANAN,
];

export const ALL_GIGI_SUSU = [
    ...GIGI_SUSU_ATAS_KANAN,
    ...GIGI_SUSU_ATAS_KIRI,
    ...GIGI_SUSU_BAWAH_KIRI,
    ...GIGI_SUSU_BAWAH_KANAN,
];

// Get image URL for kondisi
export const getKondisiImageUrl = (kondisi: string): string => {
    const kondisiData = KONDISI_GIGI[kondisi];
    if (kondisiData) {
        return `/assets/odontogram/png/${kondisiData.image}`;
    }
    return `/assets/odontogram/png/sou.png`;
};

// Get kondisi label
export const getKondisiLabel = (kondisi: string): string => {
    return KONDISI_GIGI[kondisi]?.label || kondisi;
};

// Kategori kondisi untuk dropdown
export const KONDISI_CATEGORIES = {
    'Normal': ['sou'],
    'Masalah': ['car', 'cfr', 'rrx', 'non', 'nvt', 'ano'],
    'Hilang/Belum Tumbuh': ['mis', 'une', 'pre'],
    'Tambalan': ['amf', 'amf-rct', 'cof-1', 'cof-2', 'cof-rct', 'fis'],
    'Crown': ['fmc', 'fmc-rct', 'poc', 'poc-rct', 'ipx-poc'],
    'Bridge': ['meb-left', 'meb-center', 'meb-right', 'mcb-left', 'mcb-right', 'pob-left', 'pob-center', 'pob-right'],
    'Lainnya': ['rct', 'frm-acr', 'migrasi-left', 'migrasi-right', 'rotasi-arahjam', 'rotasi-balikjam'],
};
