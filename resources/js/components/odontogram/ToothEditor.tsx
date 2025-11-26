import { DindingStatus, GigiData } from '@/types';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Textarea } from '@/components/ui/textarea';
import { KONDISI_GIGI, KONDISI_CATEGORIES, getKondisiImageUrl } from './constants';
import { cn } from '@/lib/utils';

interface ToothEditorProps {
    nomorGigi: string;
    data: GigiData;
    onChange: (data: GigiData) => void;
}

export default function ToothEditor({ nomorGigi, data, onChange }: ToothEditorProps) {
    const handleKondisiChange = (value: string) => {
        onChange({ ...data, kondisi: value });
    };

    const handleDindingChange = (position: keyof GigiData, value: DindingStatus) => {
        onChange({ ...data, [position]: value });
    };

    const handleKeteranganChange = (value: string) => {
        onChange({ ...data, keterangan: value });
    };

    const getDindingButtonClass = (current: DindingStatus | undefined, target: DindingStatus) => {
        if (current === target) {
            if (target === 'normal') return 'bg-sky-500 text-white';
            if (target === 'bermasalah') return 'bg-orange-500 text-white';
        }
        return 'bg-gray-100 hover:bg-gray-200';
    };

    const dindingPositions: { key: keyof GigiData; label: string }[] = [
        { key: 'dinding_atas', label: 'Atas' },
        { key: 'dinding_bawah', label: 'Bawah' },
        { key: 'dinding_kiri', label: 'Kiri' },
        { key: 'dinding_kanan', label: 'Kanan' },
        { key: 'dinding_tengah', label: 'Tengah' },
    ];

    return (
        <div className="space-y-4 p-4 border rounded-lg bg-gray-50">
            <h3 className="font-semibold text-lg">
                Gigi {nomorGigi}
            </h3>

            {/* Preview Image */}
            <div className="flex justify-center">
                <img
                    src={getKondisiImageUrl(data.kondisi)}
                    alt={`Gigi ${nomorGigi}`}
                    className="w-20 h-auto"
                />
            </div>

            {/* Kondisi Dropdown */}
            <div className="space-y-2">
                <Label>Kondisi Gigi</Label>
                <Select value={data.kondisi} onValueChange={handleKondisiChange}>
                    <SelectTrigger>
                        <SelectValue placeholder="Pilih kondisi gigi" />
                    </SelectTrigger>
                    <SelectContent className="max-h-[300px]">
                        {Object.entries(KONDISI_CATEGORIES).map(([category, kondisiList]) => (
                            <div key={category}>
                                <div className="px-2 py-1 text-xs font-semibold text-gray-500 bg-gray-100">
                                    {category}
                                </div>
                                {kondisiList.map((kondisi) => (
                                    <SelectItem key={kondisi} value={kondisi}>
                                        <div className="flex items-center gap-2">
                                            <img
                                                src={getKondisiImageUrl(kondisi)}
                                                alt={kondisi}
                                                className="w-6 h-6 object-contain"
                                            />
                                            <span>{KONDISI_GIGI[kondisi]?.label || kondisi}</span>
                                        </div>
                                    </SelectItem>
                                ))}
                            </div>
                        ))}
                    </SelectContent>
                </Select>
            </div>

            {/* Dinding Gigi */}
            <div className="space-y-2">
                <Label>Dinding Gigi</Label>
                <div className="grid grid-cols-1 gap-2">
                    {dindingPositions.map(({ key, label }) => (
                        <div key={key} className="flex items-center justify-between">
                            <span className="text-sm">{label}</span>
                            <div className="flex gap-1">
                                <button
                                    type="button"
                                    onClick={() => handleDindingChange(key, null)}
                                    className={cn(
                                        "px-2 py-1 text-xs rounded",
                                        !data[key] ? 'bg-gray-500 text-white' : 'bg-gray-100 hover:bg-gray-200'
                                    )}
                                >
                                    -
                                </button>
                                <button
                                    type="button"
                                    onClick={() => handleDindingChange(key, 'normal')}
                                    className={cn(
                                        "px-2 py-1 text-xs rounded",
                                        getDindingButtonClass(data[key] as DindingStatus, 'normal')
                                    )}
                                >
                                    Normal
                                </button>
                                <button
                                    type="button"
                                    onClick={() => handleDindingChange(key, 'bermasalah')}
                                    className={cn(
                                        "px-2 py-1 text-xs rounded",
                                        getDindingButtonClass(data[key] as DindingStatus, 'bermasalah')
                                    )}
                                >
                                    Bermasalah
                                </button>
                            </div>
                        </div>
                    ))}
                </div>
            </div>

            {/* Keterangan */}
            <div className="space-y-2">
                <Label>Keterangan</Label>
                <Textarea
                    value={data.keterangan || ''}
                    onChange={(e) => handleKeteranganChange(e.target.value)}
                    placeholder="Keterangan tambahan untuk gigi ini..."
                    rows={2}
                />
            </div>
        </div>
    );
}
