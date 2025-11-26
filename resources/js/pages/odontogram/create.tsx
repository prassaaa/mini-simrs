import { useState } from 'react';
import { Head, useForm } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem, Kunjungan, GigiData, OdontogramFormData, Odontogram } from '@/types';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Checkbox } from '@/components/ui/checkbox';
import { OdontogramChart, ToothEditor, ALL_GIGI_DEWASA, ALL_GIGI_SUSU } from '@/components/odontogram';
import { format } from 'date-fns';
import { id } from 'date-fns/locale';
import { Save, Copy } from 'lucide-react';

interface Props {
    kunjungan: Kunjungan;
    previousOdontogram: Odontogram | null;
    kondisiGigi: Record<string, string>;
    gigiDewasa: string[];
    gigiSusu: string[];
}

export default function CreateOdontogram({ kunjungan, previousOdontogram }: Props) {
    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Kunjungan', href: '/kunjungan' },
        { title: kunjungan.no_registrasi_kunjungan, href: `/kunjungan/${kunjungan.id}` },
        { title: 'Odontogram Baru', href: '#' },
    ];

    const [selectedGigi, setSelectedGigi] = useState<string | null>(null);

    // Initialize gigi data with all teeth set to 'sou' (sound/normal)
    const initializeGigiData = (): Record<string, GigiData> => {
        const data: Record<string, GigiData> = {};
        [...ALL_GIGI_DEWASA, ...ALL_GIGI_SUSU].forEach((nomor) => {
            data[nomor] = { kondisi: 'sou' };
        });
        return data;
    };

    const { data, setData, post, processing } = useForm<OdontogramFormData>({
        pemeriksaan_ekstra_oral: '',
        pemeriksaan_intra_oral: '',
        occlusi: 'normal_bite',
        torus_palatinus: 'tidak_ada',
        torus_mandibularis: 'tidak_ada',
        palatum: 'sedang',
        diastema: false,
        gigi_anomali: false,
        status_d: 0,
        status_m: 0,
        status_f: 0,
        hasil_pemeriksaan_penunjang: '',
        diagnosa: '',
        planning: '',
        edukasi: '',
        gigi: initializeGigiData(),
    });

    const handleGigiChange = (nomorGigi: string, gigiData: GigiData) => {
        setData('gigi', {
            ...data.gigi,
            [nomorGigi]: gigiData,
        });
    };

    const handleCopyFromPrevious = () => {
        if (!previousOdontogram) return;

        // Copy data from previous odontogram
        setData({
            ...data,
            pemeriksaan_ekstra_oral: previousOdontogram.pemeriksaan_ekstra_oral || '',
            pemeriksaan_intra_oral: previousOdontogram.pemeriksaan_intra_oral || '',
            occlusi: previousOdontogram.occlusi,
            torus_palatinus: previousOdontogram.torus_palatinus,
            torus_mandibularis: previousOdontogram.torus_mandibularis,
            palatum: previousOdontogram.palatum,
            diastema: previousOdontogram.diastema,
            gigi_anomali: previousOdontogram.gigi_anomali,
            gigi: previousOdontogram.gigi_list?.reduce((acc, gigi) => {
                acc[gigi.nomor_gigi] = {
                    kondisi: gigi.kondisi,
                    dinding_atas: gigi.dinding_atas,
                    dinding_bawah: gigi.dinding_bawah,
                    dinding_kiri: gigi.dinding_kiri,
                    dinding_kanan: gigi.dinding_kanan,
                    dinding_tengah: gigi.dinding_tengah,
                    keterangan: gigi.keterangan,
                };
                return acc;
            }, {} as Record<string, GigiData>) || data.gigi,
        });
    };

    const calculateDMF = () => {
        let d = 0, m = 0, f = 0;

        Object.values(data.gigi).forEach((gigi) => {
            if (gigi.kondisi === 'car') d++;
            if (gigi.kondisi === 'mis') m++;
            if (['amf', 'amf-rct', 'cof-1', 'cof-2', 'cof-rct', 'fis'].includes(gigi.kondisi)) f++;
        });

        setData({
            ...data,
            status_d: d,
            status_m: m,
            status_f: f,
        });
    };

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(`/kunjungan/${kunjungan.id}/odontogram`);
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Buat Odontogram" />

            <div className="flex h-full flex-1 flex-col gap-6 p-6">
                {/* Info Kunjungan */}
                <Card>
                    <CardHeader>
                        <CardTitle>Informasi Kunjungan</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div className="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                            <div>
                                <span className="text-muted-foreground">No. Registrasi:</span>
                                <p className="font-medium">{kunjungan.no_registrasi_kunjungan}</p>
                            </div>
                            <div>
                                <span className="text-muted-foreground">Pasien:</span>
                                <p className="font-medium">{kunjungan.pasien?.nama_pasien}</p>
                                <p className="text-xs text-muted-foreground">No. RM: {kunjungan.no_rm}</p>
                            </div>
                            <div>
                                <span className="text-muted-foreground">Dokter:</span>
                                <p className="font-medium">{kunjungan.dokter?.nama_dokter}</p>
                            </div>
                            <div>
                                <span className="text-muted-foreground">Tanggal:</span>
                                <p className="font-medium">
                                    {format(new Date(kunjungan.tanggal_kunjungan), 'dd MMMM yyyy', { locale: id })}
                                </p>
                            </div>
                        </div>

                        {previousOdontogram && (
                            <div className="mt-4 p-3 bg-blue-50 rounded-lg">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <p className="text-sm font-medium text-blue-800">
                                            Ditemukan odontogram sebelumnya
                                        </p>
                                        <p className="text-xs text-blue-600">
                                            Tanggal: {format(new Date(previousOdontogram.created_at), 'dd MMM yyyy', { locale: id })}
                                        </p>
                                    </div>
                                    <Button
                                        type="button"
                                        variant="outline"
                                        size="sm"
                                        onClick={handleCopyFromPrevious}
                                    >
                                        <Copy className="w-4 h-4 mr-2" />
                                        Salin Data
                                    </Button>
                                </div>
                            </div>
                        )}
                    </CardContent>
                </Card>

                <form onSubmit={handleSubmit}>
                    <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        {/* Left Column - Odontogram Chart */}
                        <div className="lg:col-span-2 space-y-6">
                            {/* Pemeriksaan Ekstra Oral */}
                            <Card>
                                <CardHeader>
                                    <CardTitle>Pemeriksaan Ekstra Oral</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <Textarea
                                        value={data.pemeriksaan_ekstra_oral}
                                        onChange={(e) => setData('pemeriksaan_ekstra_oral', e.target.value)}
                                        placeholder="Hasil pemeriksaan ekstra oral..."
                                        rows={3}
                                    />
                                </CardContent>
                            </Card>

                            {/* Odontogram Chart */}
                            <Card>
                                <CardHeader>
                                    <CardTitle>Pemeriksaan Intra Oral - Odontogram</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <OdontogramChart
                                        gigiData={data.gigi}
                                        selectedGigi={selectedGigi}
                                        onSelectGigi={setSelectedGigi}
                                    />
                                </CardContent>
                            </Card>

                            {/* Pemeriksaan Lainnya */}
                            <Card>
                                <CardHeader>
                                    <CardTitle>Pemeriksaan Lainnya</CardTitle>
                                </CardHeader>
                                <CardContent className="space-y-4">
                                    <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        {/* Occlusi */}
                                        <div className="space-y-2">
                                            <Label>Occlusi</Label>
                                            <Select
                                                value={data.occlusi}
                                                onValueChange={(value) => setData('occlusi', value as typeof data.occlusi)}
                                            >
                                                <SelectTrigger>
                                                    <SelectValue />
                                                </SelectTrigger>
                                                <SelectContent>
                                                    <SelectItem value="normal_bite">Normal Bite</SelectItem>
                                                    <SelectItem value="cross_bite">Cross Bite</SelectItem>
                                                    <SelectItem value="steep_bite">Steep Bite</SelectItem>
                                                </SelectContent>
                                            </Select>
                                        </div>

                                        {/* Torus Palatinus */}
                                        <div className="space-y-2">
                                            <Label>Torus Palatinus</Label>
                                            <Select
                                                value={data.torus_palatinus}
                                                onValueChange={(value) => setData('torus_palatinus', value as typeof data.torus_palatinus)}
                                            >
                                                <SelectTrigger>
                                                    <SelectValue />
                                                </SelectTrigger>
                                                <SelectContent>
                                                    <SelectItem value="tidak_ada">Tidak Ada</SelectItem>
                                                    <SelectItem value="kecil">Kecil</SelectItem>
                                                    <SelectItem value="sedang">Sedang</SelectItem>
                                                    <SelectItem value="besar">Besar</SelectItem>
                                                    <SelectItem value="multiple">Multiple</SelectItem>
                                                </SelectContent>
                                            </Select>
                                        </div>

                                        {/* Torus Mandibularis */}
                                        <div className="space-y-2">
                                            <Label>Torus Mandibularis</Label>
                                            <Select
                                                value={data.torus_mandibularis}
                                                onValueChange={(value) => setData('torus_mandibularis', value as typeof data.torus_mandibularis)}
                                            >
                                                <SelectTrigger>
                                                    <SelectValue />
                                                </SelectTrigger>
                                                <SelectContent>
                                                    <SelectItem value="tidak_ada">Tidak Ada</SelectItem>
                                                    <SelectItem value="kiri">Sisi Kiri</SelectItem>
                                                    <SelectItem value="kanan">Sisi Kanan</SelectItem>
                                                    <SelectItem value="kedua">Kedua Sisi</SelectItem>
                                                </SelectContent>
                                            </Select>
                                        </div>

                                        {/* Palatum */}
                                        <div className="space-y-2">
                                            <Label>Palatum</Label>
                                            <Select
                                                value={data.palatum}
                                                onValueChange={(value) => setData('palatum', value as typeof data.palatum)}
                                            >
                                                <SelectTrigger>
                                                    <SelectValue />
                                                </SelectTrigger>
                                                <SelectContent>
                                                    <SelectItem value="dalam">Dalam</SelectItem>
                                                    <SelectItem value="sedang">Sedang</SelectItem>
                                                    <SelectItem value="rendah">Rendah</SelectItem>
                                                </SelectContent>
                                            </Select>
                                        </div>

                                        {/* Diastema */}
                                        <div className="flex items-center space-x-2 pt-6">
                                            <Checkbox
                                                id="diastema"
                                                checked={data.diastema}
                                                onCheckedChange={(checked) => setData('diastema', checked as boolean)}
                                            />
                                            <Label htmlFor="diastema">Diastema</Label>
                                        </div>

                                        {/* Gigi Anomali */}
                                        <div className="flex items-center space-x-2 pt-6">
                                            <Checkbox
                                                id="gigi_anomali"
                                                checked={data.gigi_anomali}
                                                onCheckedChange={(checked) => setData('gigi_anomali', checked as boolean)}
                                            />
                                            <Label htmlFor="gigi_anomali">Gigi Anomali</Label>
                                        </div>
                                    </div>

                                    {/* DMF Status */}
                                    <div className="grid grid-cols-4 gap-4 pt-4 border-t">
                                        <div className="space-y-2">
                                            <Label>Status D (Decay)</Label>
                                            <Input
                                                type="number"
                                                min={0}
                                                value={data.status_d}
                                                onChange={(e) => setData('status_d', parseInt(e.target.value) || 0)}
                                            />
                                        </div>
                                        <div className="space-y-2">
                                            <Label>Status M (Missing)</Label>
                                            <Input
                                                type="number"
                                                min={0}
                                                value={data.status_m}
                                                onChange={(e) => setData('status_m', parseInt(e.target.value) || 0)}
                                            />
                                        </div>
                                        <div className="space-y-2">
                                            <Label>Status F (Filled)</Label>
                                            <Input
                                                type="number"
                                                min={0}
                                                value={data.status_f}
                                                onChange={(e) => setData('status_f', parseInt(e.target.value) || 0)}
                                            />
                                        </div>
                                        <div className="flex items-end">
                                            <Button type="button" variant="outline" onClick={calculateDMF}>
                                                Hitung Otomatis
                                            </Button>
                                        </div>
                                    </div>
                                </CardContent>
                            </Card>

                            {/* Diagnosa & Planning */}
                            <Card>
                                <CardHeader>
                                    <CardTitle>Diagnosa & Planning</CardTitle>
                                </CardHeader>
                                <CardContent className="space-y-4">
                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div className="space-y-2">
                                            <Label>Hasil Pemeriksaan Penunjang</Label>
                                            <Textarea
                                                value={data.hasil_pemeriksaan_penunjang}
                                                onChange={(e) => setData('hasil_pemeriksaan_penunjang', e.target.value)}
                                                placeholder="Hasil pemeriksaan penunjang..."
                                                rows={3}
                                            />
                                        </div>
                                        <div className="space-y-2">
                                            <Label>Diagnosa</Label>
                                            <Textarea
                                                value={data.diagnosa}
                                                onChange={(e) => setData('diagnosa', e.target.value)}
                                                placeholder="Diagnosa..."
                                                rows={3}
                                            />
                                        </div>
                                        <div className="space-y-2">
                                            <Label>Planning / Rencana</Label>
                                            <Textarea
                                                value={data.planning}
                                                onChange={(e) => setData('planning', e.target.value)}
                                                placeholder="Rencana tindakan..."
                                                rows={3}
                                            />
                                        </div>
                                        <div className="space-y-2">
                                            <Label>Edukasi</Label>
                                            <Textarea
                                                value={data.edukasi}
                                                onChange={(e) => setData('edukasi', e.target.value)}
                                                placeholder="Edukasi kepada pasien..."
                                                rows={3}
                                            />
                                        </div>
                                    </div>
                                </CardContent>
                            </Card>
                        </div>

                        {/* Right Column - Tooth Editor */}
                        <div className="space-y-6">
                            <Card className="sticky top-6">
                                <CardHeader>
                                    <CardTitle>Edit Gigi</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    {selectedGigi ? (
                                        <ToothEditor
                                            nomorGigi={selectedGigi}
                                            data={data.gigi[selectedGigi] || { kondisi: 'sou' }}
                                            onChange={(gigiData) => handleGigiChange(selectedGigi, gigiData)}
                                        />
                                    ) : (
                                        <div className="text-center py-8 text-muted-foreground">
                                            <p>Klik pada gigi di chart untuk mengedit</p>
                                        </div>
                                    )}
                                </CardContent>
                            </Card>

                            {/* Submit Button */}
                            <Button type="submit" className="w-full" disabled={processing}>
                                <Save className="w-4 h-4 mr-2" />
                                {processing ? 'Menyimpan...' : 'Simpan Odontogram'}
                            </Button>
                        </div>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}
