import { GigiData } from '@/types';
import Tooth from './Tooth';
import {
    GIGI_DEWASA_ATAS_KANAN,
    GIGI_DEWASA_ATAS_KIRI,
    GIGI_DEWASA_BAWAH_KANAN,
    GIGI_DEWASA_BAWAH_KIRI,
    GIGI_SUSU_ATAS_KANAN,
    GIGI_SUSU_ATAS_KIRI,
    GIGI_SUSU_BAWAH_KANAN,
    GIGI_SUSU_BAWAH_KIRI,
} from './constants';

interface OdontogramChartProps {
    gigiData: Record<string, GigiData>;
    selectedGigi: string | null;
    onSelectGigi: (nomorGigi: string) => void;
    readOnly?: boolean;
}

export default function OdontogramChart({
    gigiData,
    selectedGigi,
    onSelectGigi,
    readOnly = false,
}: OdontogramChartProps) {
    const getGigiData = (nomorGigi: string): GigiData => {
        return gigiData[nomorGigi] || { kondisi: 'sou' };
    };

    const renderRow = (gigiArray: string[], reverse = false) => {
        const items = reverse ? [...gigiArray].reverse() : gigiArray;
        return items.map((nomor) => (
            <Tooth
                key={nomor}
                nomorGigi={nomor}
                data={getGigiData(nomor)}
                onSelect={onSelectGigi}
                isSelected={selectedGigi === nomor}
                readOnly={readOnly}
            />
        ));
    };

    return (
        <div className="w-full overflow-x-auto">
            <div className="min-w-[700px] p-4">
                {/* Keterangan */}
                <div className="flex gap-6 mb-4 text-sm">
                    <div className="flex items-center gap-2">
                        <span className="w-4 h-4 rounded bg-sky-500"></span>
                        <span>Dinding Normal</span>
                    </div>
                    <div className="flex items-center gap-2">
                        <span className="w-4 h-4 rounded bg-orange-500"></span>
                        <span>Dinding Bermasalah</span>
                    </div>
                </div>

                {/* Header */}
                <div className="flex justify-center mb-2">
                    <div className="flex items-center gap-4 text-sm font-semibold text-gray-600">
                        <span>KANAN</span>
                        <span className="text-lg">|</span>
                        <span>KIRI</span>
                    </div>
                </div>

                {/* Rahang Atas - Gigi Dewasa */}
                <div className="flex justify-center border-b-2 border-gray-300 pb-2">
                    <div className="flex">
                        {renderRow(GIGI_DEWASA_ATAS_KANAN)}
                    </div>
                    <div className="w-px bg-gray-400 mx-1"></div>
                    <div className="flex">
                        {renderRow(GIGI_DEWASA_ATAS_KIRI)}
                    </div>
                </div>

                {/* Rahang Atas - Gigi Susu */}
                <div className="flex justify-center border-b-2 border-gray-300 pb-2 pt-2">
                    <div className="flex justify-end" style={{ width: '50%' }}>
                        <div className="flex">
                            {renderRow(GIGI_SUSU_ATAS_KANAN)}
                        </div>
                    </div>
                    <div className="w-px bg-gray-400 mx-1"></div>
                    <div className="flex justify-start" style={{ width: '50%' }}>
                        <div className="flex">
                            {renderRow(GIGI_SUSU_ATAS_KIRI)}
                        </div>
                    </div>
                </div>

                {/* Rahang Bawah - Gigi Susu */}
                <div className="flex justify-center border-b-2 border-gray-300 pb-2 pt-2">
                    <div className="flex justify-end" style={{ width: '50%' }}>
                        <div className="flex">
                            {renderRow(GIGI_SUSU_BAWAH_KANAN)}
                        </div>
                    </div>
                    <div className="w-px bg-gray-400 mx-1"></div>
                    <div className="flex justify-start" style={{ width: '50%' }}>
                        <div className="flex">
                            {renderRow(GIGI_SUSU_BAWAH_KIRI)}
                        </div>
                    </div>
                </div>

                {/* Rahang Bawah - Gigi Dewasa */}
                <div className="flex justify-center pt-2">
                    <div className="flex">
                        {renderRow(GIGI_DEWASA_BAWAH_KANAN)}
                    </div>
                    <div className="w-px bg-gray-400 mx-1"></div>
                    <div className="flex">
                        {renderRow(GIGI_DEWASA_BAWAH_KIRI)}
                    </div>
                </div>
            </div>
        </div>
    );
}
