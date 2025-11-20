import TransaksiController from '@/actions/App/Http/Controllers/TransaksiController';
import Heading from '@/components/heading';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem, type Kunjungan } from '@/types';
import { Form, Head, Link } from '@inertiajs/react';
import { format } from 'date-fns';
import { Plus, Trash2 } from 'lucide-react';
import { useState } from 'react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Transaksi',
        href: TransaksiController.index().url,
    },
    {
        title: 'Tambah Transaksi',
        href: TransaksiController.create().url,
    },
];

interface Props {
    kunjungans: Kunjungan[];
    selectedKunjungan?: string;
}

interface DetailItem {
    nama_tindakan: string;
    harga: number;
    qty: number;
}

export default function Create({ kunjungans, selectedKunjungan }: Props) {
    const [details, setDetails] = useState<DetailItem[]>([
        { nama_tindakan: '', harga: 0, qty: 1 },
    ]);

    const addDetail = () => {
        setDetails([...details, { nama_tindakan: '', harga: 0, qty: 1 }]);
    };

    const removeDetail = (index: number) => {
        if (details.length > 1) {
            setDetails(details.filter((_, i) => i !== index));
        }
    };

    const updateDetail = (index: number, field: keyof DetailItem, value: string | number) => {
        const newDetails = [...details];
        newDetails[index] = { ...newDetails[index], [field]: value };
        setDetails(newDetails);
    };

    const calculateSubtotal = (harga: number, qty: number) => {
        return harga * qty;
    };

    const calculateTotal = () => {
        return details.reduce((sum, detail) => sum + calculateSubtotal(detail.harga, detail.qty), 0);
    };

    const formatCurrency = (value: number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
        }).format(value);
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Tambah Transaksi" />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <Heading title="Tambah Transaksi Billing" />

                <div className="mx-auto w-full max-w-4xl rounded-xl border border-sidebar-border/70 bg-card p-6 dark:border-sidebar-border">
                    <Form {...TransaksiController.store.form()} className="space-y-6">
                        {({ processing, errors }) => (
                            <>
                                {/* Hidden inputs for details array */}
                                {details.map((detail, index) => (
                                    <div key={index} style={{ display: 'none' }}>
                                        <input
                                            type="hidden"
                                            name={`details[${index}][nama_tindakan]`}
                                            value={detail.nama_tindakan}
                                        />
                                        <input
                                            type="hidden"
                                            name={`details[${index}][harga]`}
                                            value={detail.harga}
                                        />
                                        <input
                                            type="hidden"
                                            name={`details[${index}][qty]`}
                                            value={detail.qty}
                                        />
                                    </div>
                                ))}

                                <div className="grid gap-2">
                                        <Label htmlFor="no_registrasi_kunjungan">
                                            No. Registrasi Kunjungan <span className="text-destructive">*</span>
                                        </Label>
                                        <Select
                                            name="no_registrasi_kunjungan"
                                            defaultValue={selectedKunjungan}
                                            required
                                        >
                                            <SelectTrigger>
                                                <SelectValue placeholder="Pilih kunjungan" />
                                            </SelectTrigger>
                                            <SelectContent>
                                                {kunjungans.map((kunjungan) => (
                                                    <SelectItem
                                                        key={kunjungan.id}
                                                        value={kunjungan.no_registrasi_kunjungan}
                                                    >
                                                        {kunjungan.no_registrasi_kunjungan} -{' '}
                                                        {kunjungan.pasien?.nama_pasien} (
                                                        {format(new Date(kunjungan.tanggal_kunjungan), 'dd MMM yyyy')}
                                                        )
                                                    </SelectItem>
                                                ))}
                                            </SelectContent>
                                        </Select>
                                        <InputError message={errors.no_registrasi_kunjungan} />
                                    </div>

                                    <div className="space-y-4">
                                        <div className="flex items-center justify-between">
                                            <Label>Detail Tindakan</Label>
                                            <Button type="button" size="sm" onClick={addDetail}>
                                                <Plus className="mr-2 h-4 w-4" />
                                                Tambah Item
                                            </Button>
                                        </div>

                                        <div className="space-y-3">
                                            {details.map((detail, index) => (
                                                <div
                                                    key={index}
                                                    className="grid grid-cols-12 gap-3 rounded-lg border p-3"
                                                >
                                                    <div className="col-span-5">
                                                        <Input
                                                            placeholder="Nama tindakan"
                                                            value={detail.nama_tindakan}
                                                            onChange={(e) =>
                                                                updateDetail(index, 'nama_tindakan', e.target.value)
                                                            }
                                                            required
                                                        />
                                                    </div>


                                                    <div className="col-span-3">
                                                        <Input
                                                            type="number"
                                                            placeholder="Harga"
                                                            value={detail.harga || ''}
                                                            onChange={(e) =>
                                                                updateDetail(index, 'harga', Number(e.target.value))
                                                            }
                                                            required
                                                        />
                                                    </div>
                                                    <div className="col-span-2">
                                                        <Input
                                                            type="number"
                                                            placeholder="Qty"
                                                            value={detail.qty}
                                                            onChange={(e) =>
                                                                updateDetail(index, 'qty', Number(e.target.value))
                                                            }
                                                            min="1"
                                                            required
                                                        />
                                                    </div>
                                                    <div className="col-span-1 flex items-center">
                                                        <Button
                                                            type="button"
                                                            variant="outline"
                                                            size="sm"
                                                            onClick={() => removeDetail(index)}
                                                            disabled={details.length === 1}
                                                        >
                                                            <Trash2 className="h-4 w-4" />
                                                        </Button>
                                                    </div>
                                                    <div className="col-span-12 text-right text-sm text-muted-foreground">
                                                        Subtotal: {formatCurrency(calculateSubtotal(detail.harga, detail.qty))}
                                                    </div>
                                                </div>
                                            ))}
                                        </div>
                                        <InputError message={errors.details} />
                                    </div>

                                    <div className="rounded-lg border bg-muted/50 p-4">
                                        <div className="flex items-center justify-between">
                                            <span className="text-lg font-semibold">Total Harga:</span>
                                            <span className="text-2xl font-bold text-primary">
                                                {formatCurrency(calculateTotal())}
                                            </span>
                                        </div>
                                    </div>

                                    <div className="flex justify-between">
                                        <Link href={TransaksiController.index().url}>
                                            <Button type="button" variant="outline">
                                                Kembali
                                            </Button>
                                        </Link>
                                        <Button type="submit" disabled={processing}>
                                            {processing ? 'Menyimpan...' : 'Simpan'}
                                        </Button>
                                    </div>
                                </>
                        )}
                    </Form>
                </div>
            </div>
        </AppLayout>
    );
}
