import { DindingStatus, GigiData } from '@/types';
import { getKondisiImageUrl } from './constants';
import { cn } from '@/lib/utils';

interface ToothProps {
    nomorGigi: string;
    data: GigiData;
    onSelect: (nomorGigi: string) => void;
    isSelected: boolean;
    showDinding?: boolean;
    readOnly?: boolean;
}

export default function Tooth({
    nomorGigi,
    data,
    onSelect,
    isSelected,
    showDinding = true,
    readOnly = false,
}: ToothProps) {
    const imageUrl = getKondisiImageUrl(data.kondisi);

    // Check if this tooth needs dinding display
    const hasDinding = data.dinding_atas || data.dinding_bawah ||
                       data.dinding_kiri || data.dinding_kanan ||
                       data.dinding_tengah;

    const getDindingColor = (status: DindingStatus | undefined) => {
        if (status === 'normal') return 'bg-sky-500';
        if (status === 'bermasalah') return 'bg-orange-500';
        return 'bg-gray-200';
    };    return (
        <div
            className={cn(
                "flex flex-col items-center gap-1 p-1 rounded transition-all cursor-pointer",
                isSelected && "bg-blue-100 ring-2 ring-blue-500",
                !readOnly && "hover:bg-gray-100"
            )}
            onClick={() => !readOnly && onSelect(nomorGigi)}
        >
            {/* Nomor Gigi (atas untuk rahang atas) */}
            {parseInt(nomorGigi) < 50 && nomorGigi[0] !== '3' && nomorGigi[0] !== '4' && nomorGigi[0] !== '7' && nomorGigi[0] !== '8' && (
                <span className="text-xs font-bold text-gray-700">{nomorGigi}</span>
            )}

            {/* Gambar Gigi */}
            <div className="relative">
                <img
                    src={imageUrl}
                    alt={`Gigi ${nomorGigi}`}
                    className="w-8 h-auto sm:w-10 md:w-12"
                />
            </div>

            {/* Dinding Gigi (5 area) */}
            {showDinding && hasDinding && (
                <div className="flex flex-col gap-0.5 mt-1">
                    {/* Dinding Atas */}
                    <div className={cn("w-6 h-1.5 rounded-sm", getDindingColor(data.dinding_atas))} />

                    {/* Dinding Kiri, Tengah, Kanan */}
                    <div className="flex gap-0.5">
                        <div className={cn("w-1.5 h-3 rounded-sm", getDindingColor(data.dinding_kiri))} />
                        <div className={cn("w-3 h-3 rounded-sm", getDindingColor(data.dinding_tengah))} />
                        <div className={cn("w-1.5 h-3 rounded-sm", getDindingColor(data.dinding_kanan))} />
                    </div>

                    {/* Dinding Bawah */}
                    <div className={cn("w-6 h-1.5 rounded-sm", getDindingColor(data.dinding_bawah))} />
                </div>
            )}

            {/* Nomor Gigi (bawah untuk rahang bawah) */}
            {(nomorGigi[0] === '3' || nomorGigi[0] === '4' || nomorGigi[0] === '7' || nomorGigi[0] === '8') && (
                <span className="text-xs font-bold text-gray-700">{nomorGigi}</span>
            )}
        </div>
    );
}
