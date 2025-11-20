import MasterPenjaminController from '@/actions/App/Http/Controllers/MasterPenjaminController';
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
import { type BreadcrumbItem, type MasterPenjamin } from '@/types';
import { Form, Head, Link } from '@inertiajs/react';

interface Props {
    penjamin: MasterPenjamin;
}

const breadcrumbs = (penjamin: MasterPenjamin): BreadcrumbItem[] => [
    {
        title: 'Master Penjamin',
        href: MasterPenjaminController.index().url,
    },
    {
        title: 'Edit Penjamin',
        href: MasterPenjaminController.edit(penjamin.id).url,
    },
];

export default function Edit({ penjamin }: Props) {
    return (
        <AppLayout breadcrumbs={breadcrumbs(penjamin)}>
            <Head title="Edit Penjamin" />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <Heading title="Edit Data Penjamin" />

                <div className="mx-auto w-full max-w-2xl rounded-xl border border-sidebar-border/70 bg-card p-6 dark:border-sidebar-border">
                    <Form {...MasterPenjaminController.update.form(penjamin.id)} className="space-y-6">
                        {({ processing, errors }) => (
                            <>
                                <div className="grid gap-2">
                                    <Label htmlFor="kode_penjamin">
                                        Kode Penjamin <span className="text-destructive">*</span>
                                    </Label>
                                    <Input
                                        id="kode_penjamin"
                                        name="kode_penjamin"
                                        defaultValue={penjamin.kode_penjamin}
                                        required
                                    />
                                    <InputError message={errors.kode_penjamin} />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="nama_penjamin">
                                        Nama Penjamin <span className="text-destructive">*</span>
                                    </Label>
                                    <Input
                                        id="nama_penjamin"
                                        name="nama_penjamin"
                                        defaultValue={penjamin.nama_penjamin}
                                        required
                                    />
                                    <InputError message={errors.nama_penjamin} />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="jenis">
                                        Jenis <span className="text-destructive">*</span>
                                    </Label>
                                    <Select name="jenis" defaultValue={penjamin.jenis} required>
                                        <SelectTrigger>
                                            <SelectValue placeholder="Pilih jenis penjamin" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectItem value="BPJS">BPJS</SelectItem>
                                            <SelectItem value="Umum">Umum</SelectItem>
                                            <SelectItem value="Asuransi">Asuransi</SelectItem>
                                        </SelectContent>
                                    </Select>
                                    <InputError message={errors.jenis} />
                                </div>

                                <div className="flex justify-between">
                                    <Link href={MasterPenjaminController.index().url}>
                                        <Button type="button" variant="outline">
                                            Kembali
                                        </Button>
                                    </Link>
                                    <Button type="submit" disabled={processing}>
                                        {processing ? 'Menyimpan...' : 'Update'}
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

